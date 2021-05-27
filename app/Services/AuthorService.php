<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Author;

/*
|--------------------------------------------------------------------------
| AuthorService
|--------------------------------------------------------------------------
|
| AuthorService je odgovaran za svu logiku koja se desava 
| unutar AuthorControllera. Ovdje je moguce definisati sve 
| pomocne metode koji su potrebni.
|
*/

class AuthorService {
    
    /**
     * Vrati sve autore iz baze podataka
     *
     * @return void
     */
    public function getAutori() {
        return DB::table('authors');
    }

    /**
     * Izvrsi validaciju podataka i edituj autora
     *
     * @param  Author  $autor
     * @return void
     */
    public function editAutor($autor) {
        //request all data, validate and update movie
        request()->validate([
            'name'=>'required',
        ]);

        $autor->name=request('name');
        $autor->biography=request('biography');

        $autor->save();
        
    }

    /**
     * Kreiraj novog autora i sacuvaj ga u bazi
     *
     * @return void
     */
    public function saveAutor() {
        //request all data, validate and update author
        request()->validate([
            'authorName'=>'required',
        ]);

        $autor = new Author();

        $autor->name=request('authorName');
        $autor->biography=request('authorBiography');

        $autor->save();

        return $autor;
    }
}