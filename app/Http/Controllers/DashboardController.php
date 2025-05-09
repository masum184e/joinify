<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Event;
use App\Models\Member;
use App\Models\Membership;
use App\Models\Payment;
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
        $isAdvisor = auth()->user()->globalRole()->where('role', 'advisor')->exists();

        if ($isPresident) {
            return $this->president();
        } elseif ($isSecretary) {
            return $this->secretary();
        } elseif ($isAccountant) {
            return $this->accountant();
        } else if ($isAdvisor) {
            return $this->advisor();
        } else {
            return redirect()->route(route: 'home');
        }
    }

    public function president()
    {
        $presidentRole = auth()
            ->user()
            ->clubRoles()
            ->where('role', 'president')
            ->first();
        $clubId = $presidentRole->club_id;

        $club = Club::with('events.guests')->find($clubId);

        if (!$club) {
            abort(404, 'Club not found');
        }

        $totalEvents = $club->events->count();

        $today = Carbon::today();

        $upcomingEventsList = $club->events
            ->where('date', '>=', $today)
            ->sortBy('date')
            ->values();

        $upcomingEvents = $upcomingEventsList->count();

        $totalGuests = $club->events->flatMap(function ($event) {
            return $event->guests;
        })->pluck('guest_id')->unique()->count();

        $members = Member::whereHas('memberships', function ($query) use ($clubId) {
            $query->where('club_id', $clubId);
        })->with('user')->get();

        $totalMembers = $members->count();

        $recentEvents = Event::where('club_id', $clubId)
            ->select('id', 'title', 'created_at')
            ->get()
            ->map(function ($event) {
                return [
                    'type' => 'Event Created',
                    'description' => "Event Title: {$event->title}",
                    'date' => $event->created_at,
                ];
            });
        $recentMembers = Membership::where('club_id', $clubId)
            ->with('member.user')
            ->get()
            ->map(function ($membership) {
                return [
                    'type' => 'New member joined',
                    'description' => "Name: {$membership->member->user->name}",
                    'date' => $membership->created_at,
                ];
            });

        $activities = collect()
            ->merge($recentEvents)
            ->merge($recentMembers)
            ->sortByDesc('date')
            ->take(5);


        return view('dashboard.president', compact('totalEvents', 'upcomingEventsList', 'totalGuests', 'clubId', 'upcomingEvents', 'totalMembers', 'activities'));
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
        $accountantRole = auth()
            ->user()
            ->clubRoles()
            ->where('role', 'accountant')
            ->first();
        $clubId = $accountantRole->club_id;
        //         public function up()
        // {
        //     Schema::create('expenses', function (Blueprint $table) {
        //         $table->id();
        //         $table->foreignId('club_id')->constrained()->onDelete('cascade');
        //         $table->string('title');
        //         $table->decimal('amount', 10, 2);
        //         $table->date('expense_date');
        //         $table->timestamps();
        //     });
        // }

        $totalRevenue = Payment::whereHas('membership', function ($query) use ($clubId) {
            $query->where('club_id', $clubId);
        })->where('payment_status', 'paid')
            ->sum('amount');

        //   $totalExpenses = Expense::where('club_id', $clubId)->sum('amount');
        $totalExpenses = 00;

        // Remaining balance
        $remainingBalance = $totalRevenue - $totalExpenses;


        $recentTransactions = Payment::whereHas('membership', function ($query) use ($clubId) {
            $query->where('club_id', $clubId);
        })
            ->where('payment_status', 'paid')
            ->orderBy('paid_at', 'desc')
            ->take(5)
            ->with(['membership.member.user'])
            ->get();

        $payments = Payment::whereHas('membership', function ($query) use ($clubId) {
            $query->where('club_id', $clubId);
        })
            ->where('payment_status', 'paid')
            ->where('paid_at', '>=', now()->subMonths(12))
            ->get();

        $monthlyRevenue = collect([]);

        // Initialize all 12 months with 0
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('Y-m');
            $monthlyRevenue[$month] = 0;
        }

        // Sum revenue per month
        foreach ($payments as $payment) {
            $month = Carbon::parse($payment->paid_at)->format('Y-m');
            if (isset($monthlyRevenue[$month])) {
                $monthlyRevenue[$month] += $payment->amount;
            }
        }


        // $revenueOverview = array_combine($monthlyRevenue->keys()->toArray(), $monthlyRevenue->values()->toArray());
        $revenueOverview = $monthlyRevenue->toArray();
        return view('dashboard.accountant', compact('totalRevenue', 'totalExpenses', 'remainingBalance', 'recentTransactions', 'revenueOverview', 'clubId'));
    }

    public function advisor()
    {
        $clubCount = Club::count();
        $memberCount = Member::count();

        $popularClubs = Club::withCount('memberships')
            ->with([
                'memberships.payment' => function ($query) {
                    $query->where('payment_status', 'paid');
                }
            ])
            ->orderBy('memberships_count', 'desc')
            ->take(3)
            ->get();

        // Calculate revenue for each popular club
        foreach ($popularClubs as $club) {
            $revenue = 0;
            foreach ($club->memberships as $membership) {
                if ($membership->payment) {
                    $revenue += $membership->payment->amount;
                }
            }
            $club->revenue = $revenue;
        }

        $clubs = Club::withCount('memberships')->get();
        $clubLabels = $clubs->pluck('name')->toArray();
        $clubMemberCount = $clubs->pluck('memberships_count')->toArray();
        $clubsMemberCount = array_combine($clubLabels, $clubMemberCount);

        $clubsWithRevenue = Club::with([
            'memberships.payment' => function ($query) {
                $query->where('payment_status', 'paid');
            }
        ])->get();

        $clubRevenue = [];

        foreach ($clubsWithRevenue as $club) {
            $totalRevenue = 0;

            foreach ($club->memberships as $membership) {
                if ($membership->payment) {
                    $totalRevenue += $membership->payment->amount;
                }
            }

            $clubRevenue[$club->name] = $totalRevenue;
        }

        // Clubs for general chart
        $clubs = Club::withCount('memberships')->get();
        $clubLabels = $clubs->pluck('name')->toArray();
        $clubMemberCount = $clubs->pluck('memberships_count')->toArray();
        $clubsMemberCount = array_combine($clubLabels, $clubMemberCount);

        // Total revenue and expenses
        $totalRevenue = Payment::where('payment_status', 'paid')->sum('amount');
        $totalExpenses = 0;
        $netBalance = $totalRevenue - $totalExpenses;

        return view('dashboard.advisor', compact('clubCount', 'memberCount', 'popularClubs', 'clubsMemberCount', 'totalRevenue', 'totalExpenses', 'netBalance', 'clubRevenue'));
    }
}
