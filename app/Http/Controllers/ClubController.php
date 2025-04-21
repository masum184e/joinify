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

class ClubController extends Controller
{
    public function index()
    {
        // Fetch all clubs with their user roles
        $clubs = Club::with(['userRoles.user'])->get();

        // Return the clubs to the view (Blade file)
        return view('dashboard.clubs', compact('clubs'));
    }

    public function show($id)
    {
        $club = Club::with(['userRoles.user'])->findOrFail($id);

        // Return the club details to the view
        return view('dashboard.club', compact('club'));
    }

    public function store(Request $request)
    {
        // Validate incoming request
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
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        DB::beginTransaction();

        try {
            // 1. Create or find users
            $president = User::firstOrCreate(
                ['email' => $request->presidentEmail],
                [
                    'name' => $request->presidentName,
                    'password' => Hash::make(env('DEFAULT_USER_PASSWORD', 'defaultPassword123')) // You may want to generate/send a real password
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

            // 2. Create the club
            $club = Club::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            // 3. Create ClubUserRole entries
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

            return response()->json([
                'success' => true,
                'message' => 'Club and roles created successfully.',
                'club_id' => $club->id,
                'redirect' => '/dashboard/clubs'
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'An error occurred.'
            ]);
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
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        // Example update logic
        // $club = Club::findOrFail($id);
        // $club->update([
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'president_name' => $request->presidentName,
        //     'president_email' => $request->presidentEmail,
        //     'accountant_name' => $request->accountantName,
        //     'accountant_email' => $request->accountantEmail,
        //     'secretary_name' => $request->programSecretaryName,
        //     'secretary_email' => $request->programSecretaryEmail,
        // ]);

        return response()->json([
            'success' => true,
            'message' => 'Club updated successfully!',
            'redirect' => '/dashboard/clubs/' . $id
        ]);
    }
}
