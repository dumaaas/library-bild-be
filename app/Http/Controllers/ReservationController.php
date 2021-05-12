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

    public function prikaziIznajmljivanjeAktivne() {
        return view('iznajmljivanjeAktivne');
    }

    public function prikaziIznajmljivanjeArhivirane() {
        return view('iznajmljivanjeArhivirane');
    }

    public function prikaziUcenikAktivne() {
        return view('ucenikAktivne');
    }

    public function prikaziUcenikArhivirane() {
        return view('ucenikArhivirane');
    }
}
