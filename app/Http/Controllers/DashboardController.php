<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $secretaryRole = auth()
            ->user()
            ->clubRoles()
            ->where('role', 'secretary')
            ->first();
        $clubId = $secretaryRole->club_id;

        $club = Club::with('events.guests')->find($clubId);

        if (!$club) {
            abort(404, 'Club not found');
        }

        $totalEvents = $club->events->count();

        $today = Carbon::today();
        $upcomingEvents = $club->events->where('date', '>=', $today)->count();

        $totalGuests = $club->events->flatMap(function ($event) {
            return $event->guests;
        })->pluck('guest_id')->unique()->count();

        $recentEvents = $club->events->sortByDesc('date')->take(5);

        return view('dashboard.secretary', compact('totalEvents', 'upcomingEvents', 'totalGuests', 'recentEvents', 'clubId'));
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
