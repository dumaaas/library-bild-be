<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentController extends Controller
{

    public function prikaziIzdavanjeDetalji() {
        return view('izdavanjeDetalji');
    }

    public function prikaziKnjigePrekoracenje() {
        return view('knjigePrekoracenje');
    }

    public function prikaziIzdateKnjige() {
        return view('izdateKnjige');
    }

    public function prikaziVraceneKnjige() {
        return view('vraceneKnjige');
    }

    public function prikaziAktivneRezervacije() {
        return view('aktivneRezervacije');
    }

    public function prikaziArhiviraneRezervacije() {
        return view('arhiviraneRezervacije');
    }

}
