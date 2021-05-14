<?php

namespace App\Http\Controllers;
use App\Models\Genre;
use DB;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function prikaziEditZanr(Genre $zanr) {
        return view('editZanr',[
        'zanr'=>$zanr
        ]);
    }

    public function prikaziSettingsZanrovi() {
        return view('settingsZanrovi',[
            'zanrovi'=>DB::table('genres')->paginate(7)
        ]);
    }

    public function prikaziNoviZanr() {
        return view('noviZanr');
    }

    public function sacuvajZanr() {
        //request all data, validate and add genre
        request()->validate([
            'nazivZanra'=>'required',
        ]);

        $zanrovi = new Genre();

        $zanrovi->name=request('nazivZanra');

        $zanrovi->save();

        return redirect('settingsZanrovi');
    }

    public function izmijeniZanr(Genre $zanr) {
        //request all data, validate and update genre
        request()->validate([
            'nazivZanraEdit'=>'required',
        ]);

        $zanr->name=request('nazivZanraEdit');

        $zanr->save();

        //return back to all genres
        return redirect('settingsZanrovi');
    }

    public function izbrisiZanr(Genre $zanr) {
        Genre::destroy($zanr->id);
        return redirect('settingsZanrovi');
    }
}
