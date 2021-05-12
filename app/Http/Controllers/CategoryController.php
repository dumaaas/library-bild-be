<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function prikaziEditKategorija() {
        return view('editKategorija');
    }

    public function prikaziNovaKategorija() {
        return view('novaKategorija');
    }
}
