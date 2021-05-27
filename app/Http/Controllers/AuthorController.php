<?php

namespace App\Http\Controllers;
use App\Models\Author;
use DB;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    private $viewFolder = 'pages/autor';

    public function prikaziAutore() {

        $viewName = $this->viewFolder . '.autori';

        return view($viewName, [
            'autori' => DB::table('authors')->paginate(7)
        ]);
    }

    public function prikaziAutora(Author $autor) {
        return view('autorProfile', [
            'autor' => $autor
        ]);
    }

    public function prikaziEditAutor(Author $autor) {
        return view('editAutor', [
            'autor' => $autor
        ]);
    }

    public function prikaziNoviAutor() {
        return view('noviAutor');
    }

    public function izmijeniAutora(Author $autor) {
        //request all data, validate and update movie
        request()->validate([
            'name'=>'required',
        ]);

        $autor->name=request('name');
        $autor->biography=request('biography');

        $autor->save();

        //return back to the edit author form
        return view('editAutor', [
            'autor' => $autor
        ]);
    }

    public function izbrisiAutora(Author $autor) {
        Author::destroy($autor->id);

        return back();
    }

    public function sacuvajAutora() {
        //request all data, validate and update author
        request()->validate([
            'authorName'=>'required',
        ]);

        $autor = new Author();

        $autor->name=request('authorName');
        $autor->biography=request('authorBiography');

        $autor->save();

        //return back to the edit author form
        return view('autorProfile', [
            'autor' => $autor
        ]);
    }
}
