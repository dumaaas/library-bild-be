<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function prikaziEditIzdavac() {
        return view('editIzdavac');
    }

    public function prikaziNoviIzdavac() {
        return view('noviIzdavac');
    }
    public function prikaziSettingsIzdavac() {
        return view('settingsIzdavac');
    }
}
