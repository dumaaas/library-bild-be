<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormatController extends Controller
{
    public function prikaziEditFormat() {
        return view('editFormat');
    }
}
