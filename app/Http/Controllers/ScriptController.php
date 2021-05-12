<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScriptController extends Controller
{
    public function prikaziEditPismo() {
        return view('editPismo');
    }
    public function prikaziSettingsPismo() {
        return view('settingsPismo');
    }
    public function prikaziNovoPismo() {
        return view('novoPismo');
    }
}
