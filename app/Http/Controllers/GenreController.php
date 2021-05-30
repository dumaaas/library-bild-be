<?php

namespace App\Http\Controllers;
use App\Models\Genre;
use DB;
use Illuminate\Http\Request;
use App\Services\GenreService;
use App\Services\UserService;

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

    public function sacuvajZanr(GenreService $genreService, UserService $userService, Request $request) {
        
        $genreService->saveGenre($userService, $request);

        return back()->with('success', 'Zanr uspjesno sacuvan!');
    }

    public function izmijeniZanr(GenreService $genreService, Genre $zanr, UserService $userService, Request $request) {
        
        $genreService->editGenre($zanr, $userService, $request);

        //return back to all genres
        return back()->with('success', 'Zanr uspjesno izmijenjen!');
    }

    public function izbrisiZanr(Genre $zanr) {
        Genre::destroy($zanr->id);
        return redirect('settingsZanrovi');
    }
}
