<?php

namespace App\Http\Controllers;
use App\Models\Genre;
use DB;
use Illuminate\Http\Request;
use App\Services\GenreService;

class GenreController extends Controller
{
    
    private $viewFolder = 'pages/settings/genres';
 
    public function prikaziEditZanr(Genre $zanr) {

        $viewName = $this->viewFolder . '.editZanr';

        $viewModel = [
            'zanr'=>$zanr
        ];

        return view($viewName,$viewModel);
    }

    public function prikaziSettingsZanrovi(GenreService $genreService) {

        $viewName = $this->viewFolder . '.settingsZanrovi';

        $viewModel = [
            'zanrovi'=> $genreService->getGenres()->paginate(7)
        ];

        return view($viewName,$viewModel);
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
