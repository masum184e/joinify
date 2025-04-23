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
                'department' => $request->department,
                'reason' => $request->reason,
            ]);

            // $club = Club::findOrFail($club_id);
            // $amount = $club->membership_fee ?? 500.00;
            $amount = 500.00;
            
            $membership = Membership::create([
                'member_id' => $member->id,
                'club_id' => $club_id,
            ]);

            $payment = Payment::create([
                'membership_id' => $membership->id,
                'payment_status' => 'pending',
                'amount' => $amount,
            ]);

            DB::commit();
            # Here you have to receive all the order data to initate the payment.
            # Let's say, your oder transaction informations are saving in a table called "orders"
            # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

            $post_data = array();
            $post_data['total_amount'] = $payment->amount; # You cant not pay less than 10
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = uniqid();

            # CUSTOMER INFORMATION
            $post_data['cus_name'] = $request->name;
            $post_data['cus_email'] = $request->email;
            $post_data['cus_add1'] = 'Customer Address';
            $post_data['cus_phone'] = '8801XXXXXXXXX';

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
            $post_data['value_a'] = "ref001";
            $post_data['value_b'] = "ref002";
            $post_data['value_c'] = "ref003";
            $post_data['value_d'] = "ref004";

            $sslc = new SslCommerzNotification();
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
            $payment_options = $sslc->makePayment($post_data, 'hosted');

            \Log::info('Form input:', $payment_options);


            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
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
        \Log::info("Transaction is Successful");

        // $tran_id = $request->input('tran_id');
        // $amount = $request->input('amount');
        // $currency = $request->input('currency');

        // $sslc = new SslCommerzNotification();

        // #Check order status in order tabel against the transaction id or order id.
        // $order_details = DB::table('orders')
        //     ->where('transaction_id', $tran_id)
        //     ->select('transaction_id', 'status', 'currency', 'amount')->first();

        // if ($order_details->status == 'Pending') {
        //     $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

        //     if ($validation) {
        //         /*
        //         That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
        //         in order table as Processing or Complete.
        //         Here you can also sent sms or email for successfull transaction to customer
        //         */
        //         $update_product = DB::table('orders')
        //             ->where('transaction_id', $tran_id)
        //             ->update(['status' => 'Processing']);

        //         echo "<br >Transaction is successfully Completed";
        //     }
        // } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
        //     /*
        //      That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
        //      */
        //     echo "Transaction is successfully Completed";
        // } else {
        //     #That means something wrong happened. You can redirect customer to your product page.
        //     echo "Invalid Transaction";
        // }


    }

    public function fail(Request $request)
    {
        \Log::info("Transaction is Failed");

        // $tran_id = $request->input('tran_id');

        // $order_details = DB::table('orders')
        //     ->where('transaction_id', $tran_id)
        //     ->select('transaction_id', 'status', 'currency', 'amount')->first();

        // if ($order_details->status == 'Pending') {
        //     $update_product = DB::table('orders')
        //         ->where('transaction_id', $tran_id)
        //         ->update(['status' => 'Failed']);
        //     echo "Transaction is Falied";
        // } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
        //     echo "Transaction is already Successful";
        // } else {
        //     echo "Transaction is Invalid";
        // }

    }

    public function cancel(Request $request)
    {
        \Log::info("Transaction is Cancelled");

        // $tran_id = $request->input('tran_id');

        // $order_details = DB::table('orders')
        //     ->where('transaction_id', $tran_id)
        //     ->select('transaction_id', 'status', 'currency', 'amount')->first();

        // if ($order_details->status == 'Pending') {
        //     $update_product = DB::table('orders')
        //         ->where('transaction_id', $tran_id)
        //         ->update(['status' => 'Canceled']);
        //     echo "Transaction is Cancel";
        // } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
        //     echo "Transaction is already Successful";
        // } else {
        //     echo "Transaction is Invalid";
        // }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
