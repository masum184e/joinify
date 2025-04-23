<?php

namespace App\Http\Controllers;

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

class ClubController extends Controller
{
    public function publicIndex()
    {
        // $clubs = Club::with(['userRoles.user'])->get();
        $clubs = Club::withCount('userRoles')
            ->select('id', 'name', 'description', 'created_at')
            ->get()
            ->map(function ($club) {
                $club->description = Str::limit($club->description, 60);
                return $club;
            });
        return view('clubs', compact('clubs'));
    }
    public function publicShow($id)
    {
        // $club = Club::with(['userRoles.user'])->findOrFail($id);
        $club = Club::select('id', 'name', 'description', 'created_at')
            ->withCount(['userRoles'])
            ->with([
                'president.user:id,name,email',
                'secretary.user:id,name,email',
                'accountant.user:id,name,email'
            ])
            ->findOrFail($id);

        return view('club', compact('club'));
    }
    public function joinClub($id)
    {
        $club = Club::select('id', 'name')->findOrFail($id);
        return view('join-club', compact('club'));
    }

    public function index()
    {
        $clubs = Club::withCount('userRoles')
            ->withCount(['userRoles'])
            ->with([
                'president.user:id,name,email',
            ])
            ->get();
        return view('dashboard.clubs', compact('clubs'));
    }

    public function show($id)
    {
        $club = Club::select('id', 'name', 'description', 'created_at')
            ->withCount(['userRoles'])
            ->with([
                'president.user:id,name,email',
                'secretary.user:id,name,email',
                'accountant.user:id,name,email'
            ])
            ->findOrFail($id);

        return view('dashboard.club', compact('club'));
    }

    public function create()
    {
        $page = 'create';
        return view('dashboard.club-form', compact('page'));
    }

    public function edit($id)
    {
        $club = Club::findOrFail($id);
        $page = 'edit';
        return view('dashboard.club-form', compact('page', 'club'));
    }

    public function destroy($id)
    {
        $club = Club::findOrFail($id);
        $club->delete();

        return redirect('/dashboard/clubs')->with('success', 'Club deleted successfully.');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',

            'presidentName' => 'required|string|max:255',
            'presidentEmail' => 'required|email|max:255',

            'accountantName' => 'required|string|max:255',
            'accountantEmail' => 'required|email|max:255',

            'programSecretaryName' => 'required|string|max:255',
            'programSecretaryEmail' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            $president = User::firstOrCreate(
                ['email' => $request->presidentEmail],
                [
                    'name' => $request->presidentName,
                    'password' => Hash::make(env('DEFAULT_USER_PASSWORD', 'defaultPassword123'))
                ]
            );

            $accountant = User::firstOrCreate(
                ['email' => $request->accountantEmail],
                [
                    'name' => $request->accountantName,
                    'password' => Hash::make(env('DEFAULT_USER_PASSWORD', 'defaultPassword123'))
                ]
            );

            $programSecretary = User::firstOrCreate(
                ['email' => $request->programSecretaryEmail],
                [
                    'name' => $request->programSecretaryName,
                    'password' => Hash::make(env('DEFAULT_USER_PASSWORD', 'defaultPassword123'))
                ]
            );

            $club = Club::create([
                'name' => $request->name,
                'description' => $request->description,
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

            return redirect('/clubs')->with('success', 'Club created successfully.');
        } catch (\Exception $e) {

            DB::rollBack();
            \Log::error('Membership payment flow failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred')
                ->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'presidentName' => 'required|string|max:255',
            'presidentEmail' => 'required|email|max:255',
            'accountantName' => 'required|string|max:255',
            'accountantEmail' => 'required|email|max:255',
            'programSecretaryName' => 'required|string|max:255',
            'programSecretaryEmail' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $club = Club::findOrFail($id);
        $club->update([
            'name' => $request->name,
            'description' => $request->description,
            'president_name' => $request->presidentName,
            'president_email' => $request->presidentEmail,
            'accountant_name' => $request->accountantName,
            'accountant_email' => $request->accountantEmail,
            'secretary_name' => $request->programSecretaryName,
            'secretary_email' => $request->programSecretaryEmail,
        ]);

        return redirect("/dashboard/clubs/{$club->id}")->with('success', 'Club updated successfully!');
    }
}
