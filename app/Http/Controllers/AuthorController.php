<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function prikaziAutore() {
        return view('autori');
    }

    public function prikaziAutora() {
        return view('autorProfile');
    }
}
