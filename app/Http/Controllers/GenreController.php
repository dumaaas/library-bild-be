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
 
    /**
     * Prikazi stranicu za editovanje zanra
     *
     * @param  Genre $zanr
     * @return void
     */
    public function prikaziEditZanr(Genre $zanr) {

        $viewName = $this->viewFolder . '.editZanr';

        $viewModel = [
            'zanr'=>$zanr
        ];

        return view($viewName,$viewModel);
    }

    /**
     * Prikazi sve zanrove
     *
     * @param  GenreService $genreService
     * @return void
     */
    public function prikaziSettingsZanrovi(GenreService $genreService) {

        $viewName = $this->viewFolder . '.settingsZanrovi';

        $viewModel = [
            'zanrovi'=> $genreService->getGenres()->paginate(7)
        ];

        return view($viewName,$viewModel);
    }

    /**
     * Prikazi stranicu za unos novog zanra
     *
     * @return void
     */
    public function prikaziNoviZanr() {
        
        $viewName = $this->viewFolder . '.noviZanr';

        return view($viewName);
    }

    /**
     * Kreiraj i sacuvaj novi zanr
     *
     * @param  GenreService $genreService
     * @param  UserService $userService
     * @param  Request $request
     */
    public function sacuvajZanr(GenreService $genreService, UserService $userService, Request $request) {
        
        $genreService->saveGenre($userService, $request);

        return back()->with('success', 'Zanr uspjesno sacuvan!');
    }

    /**
     * Izmijeni podatke o zanru
     *
     * @param  Genre $zanr
     * @param  GenreService $genreService
     * @param  UserService $userService
     * @param  Request $request
     * @return void
     */
    public function izmijeniZanr(Genre $zanr, GenreService $genreService, UserService $userService, Request $request) {
        
        $genreService->editGenre($zanr, $userService, $request);

        //return back to all genres
        return back()->with('success', 'Zanr uspjesno izmijenjen!');
    }

    /**
     * Izbrisi zanr
     *
     * @param  Genre $zanr
     */
    public function izbrisiZanr(Genre $zanr) {
        Genre::destroy($zanr->id);
        return redirect('settingsZanrovi');
    }
}
