<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function prikaziEditKnjiga() {
        return view('editKnjiga');
    }

    public function prikaziEditKnjigaMultimedija() {
        return view('editKnjigaMultimedija');
    }

    public function prikaziEditKnjigaSpecifikacija() {
        return view('editKnjigaSpecifikacija');
    }

    public function prikaziEvidencijaKnjiga() {
        return view('evidencijaKnjiga');
    }

    public function prikaziEvidencijaKnjigaMultimedija() {
        return view('evidencijaKnjigaMultimedija');
    }

    public function prikaziKnjigaOsnovniDetalji() {
        return view('knjigaOsnovniDetalji');
    }

    public function prikaziKnjigaSpecifikacija() {
        return view('knjigaSpecifikacija');
    }

    public function prikaziNovaKnjiga() {
        return view('novaKnjiga');
    }

    public function prikaziNovaKnjigaMultimedija() {
        return view('novaKnjigaMultimedija');
    }

    public function prikaziNovaKnjigaSpecifikacija() {
        return view('novaKnjigaSpecifikacija');
    }

    public function prikaziVratiKnjigu() {
        return view('vratiKnjigu');
    }

    public function prikaziOtpisiKnjigu() {
        return view('otpisiKnjigu');
    }

    public function prikaziRezervisiKnjigu() {
        return view('rezervisiKnjigu');
    }

    public function prikaziIzdajKnjigu() {
        return view('izdajKnjigu');
    }

    public function prikaziIzdajKnjiguError() {
        return view('izdajKnjiguError');
    }
}
