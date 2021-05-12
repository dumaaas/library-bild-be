<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BindingController extends Controller
{
    public function prikaziEditPovez() {
        return view('editPovez');
    }

    public function prikaziNoviPovez() {
        return view('noviPovez');
    }
    public function prikaziSettingsPovez() {
        return view('settingsPovez');
    }
}
