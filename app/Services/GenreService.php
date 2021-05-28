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

    public function saveGenre($userService, $request) {
        //request all data, validate and add genre
        request()->validate([
            'nazivZanra'=>'required',
            'userImage' => 'image|nullable|max: 1999'
        ]);

        $zanr = new Genre();

        $zanr->name=request('nazivZanra');
        $userService->uploadPhoto($zanr, $request);

        $zanr->save();
    }

    public function editGenre($zanr, $userService, $request) {
         //request all data, validate and update genre
         request()->validate([
            'nazivZanraEdit'=>'required',
            'userImage' => 'image|nullable|max: 1999'
        ]);

        $zanr->name=request('nazivZanraEdit');
        $userService->uploadEditPhoto($zanr, $request);

        $zanr->save();
    }
    
}