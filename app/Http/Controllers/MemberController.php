<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    public function index(Request $request, $clubId)
    {
        // Check authorization
        $isAccountantOrPresident = auth()->user()->clubRoles()
            ->whereIn('role', ['accountant', 'president'])
            ->exists();

        if (!$isAccountantOrPresident) {
            abort(403, 'Unauthorized action.');
        }

        // Validate club ID
        if (auth()->user()->clubRoles()->first()->club_id != $clubId) {
            abort(404, 'Club not found');
        }

        // Get search query
        $search = $request->get('search');

        // Build the query
        $membersQuery = Member::whereHas('memberships', function ($query) use ($clubId) {
            $query->where('club_id', $clubId);
        })->with(['user', 'memberships.payment']);

        // Apply search filter
        if ($search) {
            $membersQuery->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Paginate results
        $members = $membersQuery->paginate(10)->appends($request->query());

        // Calculate statistics
        $stats = $this->getMemberStats($clubId);

        return view('dashboard.members', compact('members', 'clubId', 'stats', 'search'));
    }

    private function getMemberStats($clubId)
    {
        $totalMembers = Member::whereHas('memberships', function ($query) use ($clubId) {
            $query->where('club_id', $clubId);
        })->count();

        $activeMembers = Member::whereHas('memberships', function ($query) use ($clubId) {
            $query->where('club_id', $clubId)
                ->whereHas('payment', function ($paymentQuery) {
                    $paymentQuery->where('payment_status', 'paid');
                });
        })->count();

        $newThisMonth = Member::whereHas('memberships', function ($query) use ($clubId) {
            $query->where('club_id', $clubId);
        })->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $pendingApprovals = Member::whereHas('memberships', function ($query) use ($clubId) {
            $query->where('club_id', $clubId)
                ->whereHas('payment', function ($paymentQuery) {
                    $paymentQuery->where('payment_status', 'pending');
                });
        })->count();

        return [
            'total' => $totalMembers,
            'active' => $activeMembers,
            'new_this_month' => $newThisMonth,
            'pending' => $pendingApprovals
        ];
    }

    public function export($clubId)
    {
        // Check authorization
        $isAccountantOrPresident = auth()->user()->clubRoles()
            ->whereIn('role', ['accountant', 'president'])
            ->exists();

        if (!$isAccountantOrPresident) {
            abort(403, 'Unauthorized action.');
        }

        // Validate club ID
        if (auth()->user()->clubRoles()->first()->club_id != $clubId) {
            abort(404, 'Club not found');
        }

        $members = Member::whereHas('memberships', function ($query) use ($clubId) {
            $query->where('club_id', $clubId);
        })->with(['user', 'memberships.payment'])->get();

        $filename = 'members_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($members) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Name', 'Email', 'Status', 'Member Since', 'Membership Fee']);

            foreach ($members as $member) {
                $payment = $member->memberships->first()->payment ?? null;
                fputcsv($file, [
                    $member->user->name,
                    $member->user->email,
                    $payment ? $payment->payment_status : 'N/A',
                    $member->created_at->format('M d, Y'),
                    $payment ? '৳' . number_format($payment->amount, 2) : '৳0.00'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function show($clubId, $memberId)
    {
        $isAccountantOrPresident = auth()->user()->clubRoles()
            ->whereIn('role', ['accountant', 'president'])
            ->exists();

        if (!$isAccountantOrPresident) {
            abort(403, 'Unauthorized action.');
        }

        $member = Member::where('id', $memberId)->with('user')->firstOrFail();

        return view('dashboard.member', compact('member', 'clubId'));
    }
}
