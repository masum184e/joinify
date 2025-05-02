<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    //
    public function index()
    {
        $popularClubs = Club::withCount('memberships','userRoles')
            ->orderBy('memberships_count', 'desc')
            ->take(3)
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

        return view('welcome', compact('popularClubs'));
    }
}
