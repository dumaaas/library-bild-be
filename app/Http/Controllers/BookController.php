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
}
