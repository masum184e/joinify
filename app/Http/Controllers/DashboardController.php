<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Member;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $isPresident = auth()->user()->clubRoles()->where('role', 'president')->exists();
        $isSecretary = auth()->user()->clubRoles()->where('role', 'secretary')->exists();
        $isAccountant = auth()->user()->clubRoles()->where('role', 'accountant')->exists();

        if ($isPresident) {
            return $this->president();
        } elseif ($isSecretary) {
            return $this->secretary();
        } elseif ($isAccountant) {
            return $this->accountant();
        } else {
            return $this->advisor();
        }
    }

    public function president()
    {
        return view('dashboard.president');
    }

    public function secretary()
    {
        return view('dashboard.secretary');
    }

    public function accountant()
    {
        return view('dashboard.accountant');
    }

    public function advisor()
    {
        $clubCount = Club::count();
        $memberCount = Member::count();

        $popularClubs = Club::withCount('memberships')
            ->orderBy('memberships_count', 'desc')
            ->take(3)
            ->get();

        $clubs = Club::withCount('memberships')->get();
        $clubLabels = $clubs->pluck('name')->toArray();
        $clubMemberCount = $clubs->pluck('memberships_count')->toArray();
        $clubsMemberCount = array_combine($clubLabels, $clubMemberCount);
    
        return view('dashboard.advisor', compact('clubCount', 'memberCount', 'popularClubs', 'clubsMemberCount'));
    }
}
