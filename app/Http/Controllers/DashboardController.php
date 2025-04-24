<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        return view('dashboard.advisor');
    }
}
