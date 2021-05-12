<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentController extends Controller
{

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

    public function prikaziUcenikIzdate() {
        return view('ucenikIzdate');
    }

    public function prikaziUcenikVracene() {
        return view('ucenikVracene');
    }

    public function prikaziUcenikPrekoracenje() {
        return view('ucenikPrekoracenje');
    }

    public function prikaziIzdateKnjige() {
        return view('izdateKnjige');
    }

    public function prikaziVraceneKnjige() {
        return view('vraceneKnjige');
    }

}
