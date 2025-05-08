<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Validator;
use App\Models\Club;
use App\Models\User;
use App\Models\Payment;
use App\Models\Member;
use App\Models\Membership;
use Illuminate\Support\Facades\Hash;

class SslCommerzPaymentController extends Controller
{

    public function index(Request $request, $club_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:15',
            'student_id' => 'required|string|max:50',
            'department' => 'required|string|max:100',
            'reason' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make(env('DEFAULT_USER_PASSWORD', 'defaultPassword123'))
            ]);

            $member = Member::create([
                'user_id' => $user->id,
                'student_id' => $request->student_id,
                // 'phone' => $request->phone,
                'department' => $request->department,
                'reason' => $request->reason,
            ]);

            $club = Club::findOrFail($club_id);
            $amount = $club->fee;

            $membership = Membership::create([
                'member_id' => $member->id,
                'club_id' => $club_id,
            ]);

            $tran_id = uniqid();
            $payment = Payment::create([
                'membership_id' => $membership->id,
                'payment_status' => 'pending',
                'amount' => $amount,
                'transaction_id' => $tran_id,
            ]);

            DB::commit();
            # Here you have to receive all the order data to initate the payment.
            # Let's say, your oder transaction informations are saving in a table called "orders"
            # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

            $post_data = array();
            $post_data['total_amount'] = $payment->amount; # You cant not pay less than 10
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = $tran_id;

            # CUSTOMER INFORMATION
            $post_data['cus_name'] = $request->name;
            $post_data['cus_email'] = $request->email;
            $post_data['cus_add1'] = 'Customer Address';
            $post_data['cus_phone'] = $request->phone;

            $post_data['cus_add2'] = "";
            $post_data['cus_city'] = "";
            $post_data['cus_state'] = "";
            $post_data['cus_postcode'] = "";
            $post_data['cus_country'] = "Bangladesh";
            $post_data['cus_fax'] = "";

            # SHIPMENT INFORMATION
            $post_data['ship_name'] = "Store Test";
            $post_data['ship_add1'] = "Dhaka";
            $post_data['ship_add2'] = "Dhaka";
            $post_data['ship_city'] = "Dhaka";
            $post_data['ship_state'] = "Dhaka";
            $post_data['ship_postcode'] = "1000";
            $post_data['ship_phone'] = "";
            $post_data['ship_country'] = "Bangladesh";

            $post_data['shipping_method'] = "NO";
            $post_data['product_name'] = "Computer";
            $post_data['product_category'] = "Goods";
            $post_data['product_profile'] = "physical-goods";

            # OPTIONAL PARAMETERS
            $post_data['value_a'] = $user->id;
            $post_data['value_b'] = $membership->id;
            $post_data['value_c'] = $payment->id;
            $post_data['value_d'] = $club_id;

            $post_data['success_url'] = '/success';
            $post_data['failed_url'] = '/fail';
            $post_data['cancel_url'] = '/cancel';

            $sslc = new SslCommerzNotification();
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
            $payment_options = $sslc->makePayment($post_data, 'hosted');


            if (!is_array($payment_options)) {
                print_r($payment_options);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Membership payment flow failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            return redirect()->back()->with('error', 'Something went wrong while processing your membership.');
        }

    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $sslc = new SslCommerzNotification();

        $payment = Payment::with('membership.member.user')->where('transaction_id', $tran_id)->first();

        if (!$payment) {
            return view('payments.fail')->with('message', 'Payment record not found.');
        }

        $is_valid = $sslc->orderValidate(
            $request->all(),
            $tran_id,
            $payment->amount,
            $request->input('currency')
        );

        if ($is_valid) {
            $payment->payment_status = 'paid';
            $payment->save();

            $member = $payment->membership->member;
            $user = $member->user;

            return view('payments.success', [
                'name' => $user->name,
                'email' => $user->email,
                'student_id' => $member->student_id,
                'department' => $member->department,
                'transaction_id' => $payment->transaction_id,
                'amount' => $payment->amount,
                'club' => $payment->membership->club->name ?? 'Club',
                'club_id' => $payment->membership->club->id ?? '/'
            ]);
        } else {
            return view('payments.fail')->with('message', 'Payment validation failed.');
        }
    }


    public function fail(Request $request)
    {
        // Log the failed transaction
        \Log::info('Transaction Failed', ['transaction_data' => $request->all()]);

        // Retrieve the transaction details
        $transaction_id = $request->tran_id;
        $payment = Payment::where('transaction_id', $transaction_id)->first();

        if ($payment) {
            // Update payment status to 'failed'
            $payment->payment_status = 'failed';
            $payment->save();
        }

        return view('payments.fail', compact('payment'));
    }

    public function cancel(Request $request)
    {
        \Log::info('Transaction Cancelled', ['transaction_data' => $request->all()]);

        // Retrieve the transaction details
        $transaction_id = $request->tran_id;
        $payment = Payment::where('transaction_id', $transaction_id)->first();

        if ($payment) {
            // Update payment status to 'cancelled'
            $payment->payment_status = 'cancelled';
            $payment->save();
        }

        return view('payments.cancel', compact('payment'));
    }

}
