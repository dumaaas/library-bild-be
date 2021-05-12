<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function prikaziBibliotekara() {
        return view('bibliotekarProfile');
    }

    public function prikaziBibliotekare() {
        return view('bibliotekari');
    }

    public function prikaziEditBibliotekar() {
        return view('editBibliotekar');
    }

    public function prikaziEditUcenik() {
        return view('editUcenik');
    }

    public function prikaziNoviBibliotekar() {
        return view('noviBibliotekar');
    }
    public function prikaziUcenike() {
        return view('ucenik');
    }
    public function prikaziUcenikProfile() {
        return view('ucenikProfile');
    }
    public function prikaziNovogUcenika() {
        return view('noviUcenik');
    }
}
