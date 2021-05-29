<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Format;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FormatService {

    public function getFormats(){
        return $formati = DB::table('formats');
    }
        
}