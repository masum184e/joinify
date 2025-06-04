<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Payment;
use App\Models\User;
use App\Models\Club;
use App\Models\ClubUserRole;
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
    public function publicIndex()
    {
        $clubs = Club::withCount('userRoles', 'memberships')
            ->select('id', 'name', 'description', 'fee', 'banner', 'created_at')
            ->get()
            ->filter(function ($club) {
                return $club->president?->verified == 1 &&
                    $club->secretary?->verified == 1 &&
                    $club->accountant?->verified == 1;
            })
            ->map(function ($club) {
                $club->description = Str::limit($club->description, 60);
                return $club;
            });
        return view('clubs', compact('clubs'));
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

        return view('club', compact('club'));
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

    public function index()
    {
        $user = auth()->user();
        if (!$user->globalRole || $user->globalRole->role !== 'advisor') {
            abort(403, 'Unauthorized action.');
        }

        $clubs = Club::withCount(['userRoles', 'memberships'])
            ->get()
            ->map(function ($club) {
                $club->description = Str::limit($club->description, 60);
                return $club;
            });
        return view('dashboard.clubs', compact('clubs'));
    }

    public function show($clubId)
    {
        $user = auth()->user();
        if (!$user->globalRole || $user->globalRole->role !== 'advisor') {
            abort(403, 'Unauthorized action.');
        }

        $club = Club::withCount(['memberships'])
            ->select('id', 'name', 'description', 'banner', 'fee', 'created_at')
            ->findOrFail($clubId);

        $clubRevenue = Payment::whereHas('membership', function ($query) use ($clubId) {
            $query->where('club_id', $clubId);
        })->where('payment_status', 'paid')
            ->sum('amount');

        return view('dashboard.club', compact('club', 'clubRevenue'));
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
