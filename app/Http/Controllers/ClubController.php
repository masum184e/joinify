<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Member;
use App\Models\Membership;
use App\Models\Payment;
use App\Models\User;
use App\Models\Club;
use App\Models\ClubUserRole;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ClubController extends Controller
{
    public function publicIndex(Request $request)
    {
        $query = Club::withCount(['userRoles', 'memberships'])
            ->with(['president', 'secretary', 'accountant', 'memberships'])
            ->select('id', 'name', 'description', 'fee', 'banner', 'created_at')
            ->whereHas('president', function($q) {
                $q->where('verified', 1);
            })
            ->whereHas('secretary', function($q) {
                $q->where('verified', 1);
            })
            ->whereHas('accountant', function($q) {
                $q->where('verified', 1);
            });

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Sort options
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        
        switch ($sortBy) {
            case 'members':
                $query->orderBy('memberships_count', $sortOrder);
                break;
            case 'name':
                $query->orderBy('name', $sortOrder);
                break;
            default:
                $query->orderBy('created_at', $sortOrder);
        }

        $clubs = $query->paginate(9)->through(function ($club) {
            $club->description = Str::limit($club->description, 60);
            return $club;
        });

        $categories = [
            'all' => 'All Clubs',
            'academic' => 'Academic',
            'arts' => 'Arts',
            'cultural' => 'Cultural',
            'sports' => 'Sports',
            'technology' => 'Technology',
            'social' => 'Social'
        ];

        return view('clubs', compact('clubs', 'categories'));
    }

    public function publicShow($clubId)
    {
        $club = Club::withCount(['userRoles', 'memberships'])
            ->select('id', 'name', 'description', 'fee', 'banner', 'created_at')
            ->findOrFail($clubId);

        if (
            $club->president?->verified != 1 ||
            $club->secretary?->verified != 1 ||
            $club->accountant?->verified != 1
        ) {
            abort(404);
        }

        $upcomingEvents = $club->events->where('date', '>=', Carbon::now());
        // Get similar clubs (same category, excluding current club)
        $similarClubs = Club::with(['president.user', 'secretary.user', 'accountant.user'])
            ->withCount('memberships')
            ->where('id', '!=', $clubId)
            ->whereHas('president', function ($q) {
                $q->where('verified', true);
            })->whereHas('secretary', function ($q) {
                $q->where('verified', true);
            })->whereHas('accountant', function ($q) {
                $q->where('verified', true);
            })
            ->take(3)
            ->get();
        return view('club', compact('club', 'upcomingEvents', 'similarClubs'));
    }
    
    public function joinClub($clubId)
    {
        $club = Club::select('id', 'name')->findOrFail($clubId);

        if (
            $club->president?->verified != 1 ||
            $club->secretary?->verified != 1 ||
            $club->accountant?->verified != 1
        ) {
            abort(404);
        }

        return view('join-club', compact('club'));
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        if (!$user->globalRole || $user->globalRole->role !== 'advisor') {
            abort(403, 'Unauthorized action.');
        }

        // Build query with filters
        $query = Club::with(['president.user', 'secretary.user', 'accountant.user'])
            ->withCount(['memberships', 'events']);

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->whereHas('president', function ($q) {
                    $q->where('verified', true);
                })->whereHas('secretary', function ($q) {
                    $q->where('verified', true);
                })->whereHas('accountant', function ($q) {
                    $q->where('verified', true);
                });
            } elseif ($request->status === 'inactive') {
                $query->where(function ($q) {
                    $q->whereDoesntHave('president', function ($subQ) {
                        $subQ->where('verified', true);
                    })->orWhereDoesntHave('secretary', function ($subQ) {
                        $subQ->where('verified', true);
                    })->orWhereDoesntHave('accountant', function ($subQ) {
                        $subQ->where('verified', true);
                    });
                });
            }
        }

        // Sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');

        switch ($sortBy) {
            case 'name':
                $query->orderBy('name', $sortOrder);
                break;
            case 'members':
                $query->orderBy('memberships_count', $sortOrder);
                break;
            case 'events':
                $query->orderBy('events_count', $sortOrder);
                break;
            case 'fee':
                $query->orderBy('fee', $sortOrder);
                break;
            default:
                $query->orderBy('created_at', $sortOrder);
        }

        $clubs = $query->paginate(12)->appends($request->query());

        // Process clubs data
        $clubs->getCollection()->transform(function ($club) {
            $club->description_short = Str::limit($club->description, 100);
            $club->is_active = $club->president?->verified &&
                $club->secretary?->verified &&
                $club->accountant?->verified;
            return $club;
        });

        // Get statistics
        $stats = [
            'total_clubs' => Club::count(),
            'active_clubs' => Club::whereHas('president', function ($q) {
                $q->where('verified', true);
            })->whereHas('secretary', function ($q) {
                $q->where('verified', true);
            })->whereHas('accountant', function ($q) {
                $q->where('verified', true);
            })->count(),
            'total_members' => Membership::count(),
            'total_events' => Event::count(),
        ];

        return view('dashboard.clubs', compact('clubs', 'stats'));
    }

    public function show($clubId)
    {
        $user = auth()->user();
        $isExecutives = auth()->user()->clubRoles()
            ->whereIn('role', ['accountant', 'secretary', 'president'])
            ->where('club_id', $clubId)
            ->exists();
        
        if($user->globalRole && $user->globalRole->role === 'advisor') {
            $isExecutives = true; // Advisors can view any club
        }
        if (!$isExecutives) {
            abort(403, 'Unauthorized action.');
        }

        $club = Club::with([
            'president.user',
            'secretary.user',
            'accountant.user',
            'memberships',
            'events' => function ($query) {
                $query->orderBy('date', 'desc')->take(5);
            }
        ])->findOrFail($clubId);

        // Get club statistics
        $stats = $this->getClubStatistics($club);

        // Get recent transactions (you'll need to implement this based on your Transaction model)
        $recentTransactions = $this->getRecentTransactions($club);

        // Get monthly transaction data for chart
        $monthlyData = $this->getMonthlyTransactionData($club);

        return view('dashboard.club', compact('club', 'stats', 'recentTransactions', 'monthlyData'));
    }

    private function getClubStatistics($club)
    {
        $now = Carbon::now();
        $thisMonth = $now->startOfMonth();
        $lastMonth = $now->copy()->subMonth()->startOfMonth();

        return [
            'total_members' => $club->memberships->count(),
            'active_members' => $club->memberships->filter(function ($membership) {
                return $membership->payment && $membership->payment->payment_status === 'paid';
            })->count(),
            'pending_members' => $club->memberships->filter(function ($membership) {
                return $membership->payment && $membership->payment->payment_status === 'pending';
            })->count(),
            'total_events' => $club->events->count(),
            'upcoming_events' => $club->events->where('date', '>=', $now)->count(),
            'past_events' => $club->events->where('date', '<', $now)->count(),
            'is_active' => $club->president?->verified &&
                $club->secretary?->verified &&
                $club->accountant?->verified,
            'created_at' => $club->created_at,
        ];
    }

    private function getRecentTransactions($club)
    {
        // This is a placeholder - implement based on your Transaction model
        return collect([
            [
                'id' => 1,
                'description' => 'Membership Fees',
                'amount' => 1200,
                'type' => 'income',
                'date' => Carbon::now()->subDays(2),
            ],
            [
                'id' => 2,
                'description' => 'Event Supplies',
                'amount' => -350,
                'type' => 'expense',
                'date' => Carbon::now()->subDays(4),
            ],
            [
                'id' => 3,
                'description' => 'Workshop Registration',
                'amount' => 800,
                'type' => 'income',
                'date' => Carbon::now()->subDays(6),
            ],
            [
                'id' => 4,
                'description' => 'Venue Rental',
                'amount' => -500,
                'type' => 'expense',
                'date' => Carbon::now()->subDays(8),
            ],
            [
                'id' => 5,
                'description' => 'Sponsorship',
                'amount' => 2000,
                'type' => 'income',
                'date' => Carbon::now()->subDays(10),
            ],
        ]);
    }

    private function getMonthlyTransactionData($club)
    {
        // This is a placeholder - implement based on your Transaction model
        return [
            'labels' => ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            'income' => [3000, 4500, 6000, 7500],
            'expenses' => [1500, 2000, 2500, 3000],
            'total_income' => 21000,
            'total_expenses' => 9000,
            'net_income' => 12000,
        ];
    }

    public function create()
    {
        $user = auth()->user();
        if (!$user->globalRole || $user->globalRole->role !== 'advisor') {
            abort(403, 'Unauthorized action.');
        }

        $page = 'create';
        return view('dashboard.club-form', compact('page'));
    }

    public function edit($clubId)
    {
        $user = auth()->user();
        if (!$user->globalRole || $user->globalRole->role !== 'advisor') {
            abort(403, 'Unauthorized action.');
        }

        $club = Club::findOrFail($clubId);
        $page = 'edit';
        return view('dashboard.club-form', compact('page', 'club'));
    }

    public function destroy($clubId)
    {
        $user = auth()->user();
        if (!$user->globalRole || $user->globalRole->role !== 'advisor') {
            abort(403, 'Unauthorized action.');
        }

        $club = Club::findOrFail($clubId);

        if ($club->banner && Storage::disk('public')->exists($club->banner)) {
            Storage::disk('public')->delete($club->banner);
        }

        $club->delete();

        return redirect('/dashboard/clubs')->with('success', 'Club deleted successfully.');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if (!$user->globalRole || $user->globalRole->role !== 'advisor') {
            abort(403, 'Unauthorized action.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'fee' => 'required|numeric',
            'president_name' => 'required|string|max:255',
            'president_email' => 'required|email',
            'secretary_name' => 'required|string|max:255',
            'secretary_email' => 'required|email',
            'accountant_name' => 'required|string|max:255',
            'accountant_email' => 'required|email',
            'banner' => 'required|image|max:2048', // 2MB max
        ]);

        $path = null;

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {

            if ($request->hasFile('banner')) {
                $path = $request->file('banner')->store('banners', 'public');
            }

            $president = User::firstOrCreate(
                ['email' => $request->president_email],
                [
                    'name' => $request->president_name,
                    'password' => Hash::make(env('DEFAULT_USER_PASSWORD', 'defaultPassword123'))
                ]
            );

            $accountant = User::firstOrCreate(
                ['email' => $request->accountant_email],
                [
                    'name' => $request->accountant_name,
                    'password' => Hash::make(env('DEFAULT_USER_PASSWORD', 'defaultPassword123'))
                ]
            );

            $programSecretary = User::firstOrCreate(
                ['email' => $request->secretary_email],
                [
                    'name' => $request->secretary_name,
                    'password' => Hash::make(env('DEFAULT_USER_PASSWORD', 'defaultPassword123'))
                ]
            );

            $club = Club::create([
                'name' => $request->name,
                'description' => $request->description,
                'banner' => $path,
                'fee' => $request->fee,
            ]);

            ClubUserRole::create([
                'club_id' => $club->id,
                'user_id' => $president->id,
                'role' => 'president',
                'verified' => false,
            ]);

            ClubUserRole::create([
                'club_id' => $club->id,
                'user_id' => $accountant->id,
                'role' => 'accountant',
                'verified' => false,
            ]);

            ClubUserRole::create([
                'club_id' => $club->id,
                'user_id' => $programSecretary->id,
                'role' => 'secretary',
                'verified' => false,
            ]);

            DB::commit();

            return redirect('/dashboard/clubs')->with('success', 'Club created successfully.');
        } catch (\Exception $e) {

            DB::rollBack();
            \Log::error('Membership payment flow failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            return redirect()->back()
                ->with('error', 'An error occurred')
                ->withInput();
        }
    }

    public function update(Request $request, $clubId)
    {
        $user = auth()->user();
        if (!$user->globalRole || $user->globalRole->role !== 'advisor') {
            abort(403, 'Unauthorized action.');
        }

        $rules = [];

        if ($request->filled('name')) {
            $rules['name'] = 'string|max:255';
        }

        if ($request->filled('description')) {
            $rules['description'] = 'string|max:1000';
        }

        if ($request->filled('fee')) {
            $rules['fee'] = 'numeric';
        }

        if ($request->filled('president_name')) {
            $rules['president_name'] = 'string|max:255';
        }

        if ($request->filled('president_email')) {
            $rules['president_email'] = 'email|max:255';
        }

        if ($request->filled('accountant_name')) {
            $rules['accountant_name'] = 'string|max:255';
        }

        if ($request->filled('accountant_email')) {
            $rules['accountant_email'] = 'email|max:255';
        }

        if ($request->filled('secretary_name')) {
            $rules['secretary_name'] = 'string|max:255';
        }

        if ($request->filled('secretary_email')) {
            $rules['secretary_email'] = 'email|max:255';
        }

        if ($request->hasFile('banner')) {
            $rules['banner'] = 'image|max:2048';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            $club = Club::findOrFail($clubId);

            if ($request->hasFile('banner')) {
                // Delete old banner if it exists
                if ($club->banner && Storage::disk('public')->exists($club->banner)) {
                    Storage::disk('public')->delete($club->banner);
                }

                // Upload new banner
                $path = $request->file('banner')->store('banners', 'public');
                $club->banner = $path;
            }

            // Only update the fields that are present in the request
            $club->fill($request->only(['name', 'description', 'fee']));
            $club->save();

            // Update role assignments
            if ($request->filled('president_email') && $request->filled('president_name')) {
                $this->updateUserRole($club->id, $request->president_email, $request->president_name, 'president');
            }

            if ($request->filled('secretary_email') && $request->filled('secretary_name')) {
                $this->updateUserRole($club->id, $request->secretary_email, $request->secretary_name, 'secretary');
            }

            if ($request->filled('accountant_email') && $request->filled('accountant_name')) {
                $this->updateUserRole($club->id, $request->accountant_email, $request->accountant_name, 'accountant');
            }

            DB::commit();

            return redirect("/dashboard/clubs/{$club->id}")->with('success', 'Club updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Club update failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);
            return redirect()->back()
                ->with('error', 'An error occurred')
                ->withInput();
        }
    }

    private function updateUserRole($clubId, $email, $name, $role)
    {
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make(env('DEFAULT_USER_PASSWORD', 'defaultPassword123')),
            ]
        );

        ClubUserRole::updateOrCreate(
            ['club_id' => $clubId, 'role' => $role],
            ['user_id' => $user->id, 'verified' => false]
        );
    }

}
