<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        \Log::info('Request data: ', $request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => true,
                'redirect' => '/dashboard'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid email or password'
        ]);
    }
}
