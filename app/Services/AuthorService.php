<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorService {
    public function getAutori() {
        return $autori = DB::table('authors');
    }

    public function editAutor($autor) {
        //request all data, validate and update movie
        request()->validate([
            'name'=>'required',
        ]);

        $autor->name=request('name');
        $autor->biography=request('biography');

        $autor->save();
        
    }

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