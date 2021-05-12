<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function prikaziDashboard() {
        return view('dashboard');
    }

    public function prikaziDashboardAktivnost() {
        return view('dashboardAktivnost');
    }
}
