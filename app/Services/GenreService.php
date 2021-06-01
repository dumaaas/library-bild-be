<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GenreService {

    /**
     * Vrati sve zanrove iz baze podataka
     *
     * @return void
     */
    public function getGenres(){
        return $zanrovi = DB::table('genres');
    }

    /**
     * Kreiraj novi zanr i sacuvaj ga u bazi
     *
     * @param  UserService $userService
     * @param  Request $request
     * @return void
     */
    public function saveGenre($userService, $request) {
        //request all data, validate and add genre
        request()->validate([
            'nazivZanra' => 'required|string|max:256',
            'userImage'  => 'nullable|mimes:jpeg,png,jpg'
        ]);

        $zanr = new Genre();

        $zanr->name = request('nazivZanra');
        $userService->uploadPhoto($zanr, $request);

        $zanr->save();
    }

    /**
     * Izvrsi validaciju podataka i edituj zanr
     *
     * @param  Genre $zanr
     * @param  UserService $userService
     * @param  Request $request
     * @return void
     */
    public function editGenre($zanr, $userService, $request) {
         //request all data, validate and update genre
         request()->validate([
            'nazivZanraEdit' => 'sometimes|string|max:256',
            'userImage'      => 'nullable|mimes:jpeg,png,jpg'
        ]);

        $zanr->name = request('nazivZanraEdit');
        $userService->uploadEditPhoto($zanr, $request);

        $zanr->save();
    }

}
