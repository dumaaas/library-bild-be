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
}
