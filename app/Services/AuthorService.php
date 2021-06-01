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
            'name'        => 'sometimes|regex:/^([^0-9]*)$/|max:128',
            'biography'   => 'nullable|string|max:4128'
        ]);

        $autor->name      = request('name');
        $autor->biography = request('biography');

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
            'authorName'        => 'required|max:128|regex:/^([^0-9]*)$/',
            'authorBiography'   => 'nullable|string|max:4128'
        ]);

        $autor = new Author();

        $autor->name      = request('authorName');
        $autor->biography = request('authorBiography');

        $autor->save();

        return $autor;
    }

    /**
     * Vrati pretrazene autore
     *
     * @return void
     */
    public function searchAutori() {

        $autori = Author::query();

        if(request('searchAutori')) {
            $autoriPretraga = request('searchAutori');
            $autori = $autori->where('name', 'LIKE', '%'.$autoriPretraga.'%');
        }

        $autori = $autori->paginate(7);

        return $autori;
    }
}
