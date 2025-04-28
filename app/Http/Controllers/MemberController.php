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

        $isAccountantOrPresident = auth()->user()->clubRoles()
            ->whereIn('role', ['accountant', 'president'])
            ->exists();

        if (!$isAccountantOrPresident) {
            abort(403, 'Unauthorized action.');
        }

        $members = Member::whereHas('memberships', function ($query) use ($clubId) {
            $query->where('club_id', $clubId);
        })->with('user')->get();

        return view('dashboard.members', compact('members', 'clubId'));
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
