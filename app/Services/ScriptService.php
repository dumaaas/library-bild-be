<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Script;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ScriptService {
    
    public function getScripts(){

        return $pisma = DB::table('scripts');
    }
}