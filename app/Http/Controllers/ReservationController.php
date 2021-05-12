<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function prikaziAktivneRezervacije() {
        return view('aktivneRezervacije');
    }

    public function prikaziArhiviraneRezervacije() {
        return view('arhiviraneRezervacije');
    }
}
