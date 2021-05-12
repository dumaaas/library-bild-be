<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentController extends Controller
{
    public function prikaziIzdajKnjigu() {
        return view('izdajKnjigu');
    }

    public function prikaziIzdajKnjiguError() {
        return view('izdajKnjiguError');
    }

    public function prikaziIzdavanjeDetalji() {
        return view('izdavanjeDetalji');
    }

    public function prikaziIznajmljivanjeIzdate() {
        return view('iznajmljivanjeIzdate');
    }

    public function prikaziIznajmljivanjePrekoracenje() {
        return view('iznajmljivanjePrekoracenje');
    }

    public function prikaziIznajmljivanjeVracene() {
        return view('iznajmljivanjeVracene');
    }

    public function prikaziKnjigePrekoracenje() {
        return view('knjigePrekoracenje');
    }

}
