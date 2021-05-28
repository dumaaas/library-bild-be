<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GenreService {
    
    public function getGenres(){
        return $zanrovi = DB::table('genres');
    }
    
}