<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function prikaziEditZanr() {
        return view('editZanr');
    }
    public function prikaziSettingsZanrovi() {
        return view('settingsZanrovi');
    }
    public function prikaziNoviZanr() {
        return view('noviZanr');
    }
}
