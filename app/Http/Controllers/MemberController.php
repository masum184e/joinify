<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    public function index($clubId)
    {
        $isAccountant = auth()->user()->clubRoles()->where('role', 'accountant')->exists();

        if (!$isAccountant) {
            abort(403, 'Unauthorized action.');
        }

        $members = Member::whereHas('memberships', function ($query) use ($clubId) {
            $query->where('club_id', $clubId);
        })->with('user')->get();

        return view('dashboard.members', compact('members', 'clubId'));
    }

    public function show($clubId, $memberId)
    {
        $isAccountant = auth()->user()->clubRoles()->where('role', 'accountant')->exists();

        if (!$isAccountant) {
            abort(403, 'Unauthorized action.');
        }

        $member = Member::where('id', $memberId)->with('user')->firstOrFail();

        return view('dashboard.member', compact('member', 'clubId'));
    }
}
