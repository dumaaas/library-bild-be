<?php

namespace App\Http\Controllers;
use App\Models\Genre;
use DB;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    
    private $viewFolder = 'pages/settings/genres';
 
    public function prikaziEditZanr(Genre $zanr) {

        $viewName = $this->viewFolder . '.editZanr';

        return view($viewName,[
        'zanr'=>$zanr
        ]);
    }

    public function prikaziSettingsZanrovi() {

        $viewName = $this->viewFolder . '.settingsZanrovi';

        return view($viewName,[
            'zanrovi'=>DB::table('genres')->paginate(7)
        ]);
    }

    public function prikaziNoviZanr() {
        
        $viewName = $this->viewFolder . '.noviZanr';

        return view($viewName);
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
