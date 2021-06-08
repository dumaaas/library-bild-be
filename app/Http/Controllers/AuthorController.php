<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Services\AuthorService;
use DB;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| AuthorController
|--------------------------------------------------------------------------
|
| AuthorController je odgovaran za povezivanje logike
| izmedju autor view-a i neophodnih Modela
|
*/

class AuthorController extends Controller
{

    private $viewFolder = 'pages/autor';

    /**
     * Prikazi sve autore
     *
     * @param  AuthorService $autorService
     * @return void
     */
    public function prikaziAutore(AuthorService $autorService) {

        $viewName = $this->viewFolder . '.autori';

        $viewModel = [
            'autori' => $autorService->getAutori()->paginate(7)
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi konkretnog autora
     *
     * @param  Author $autor
     * @return void
     */
    public function prikaziAutora(Author $autor) {

        $viewName = $this->viewFolder . '.autorProfile';

        $viewModel = [
            'autor' => $autor
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi stranicu za editovanje autora
     *
     * @param  Author $autor
     * @return void
     */
    public function prikaziEditAutor(Author $autor) {
        $viewName = $this->viewFolder . '.editAutor';

        $viewModel = [
            'autor' => $autor
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi stranicu za unos novog autora
     *
     * @return void
     */
    public function prikaziNoviAutor() {
        $viewName = $this->viewFolder . '.noviAutor';

        return view($viewName);
    }

    /**
     * Izmijeni podatke o autoru
     *
     * @param  Author $autor
     * @param  AuthorService $autorService
     * @return void
     */
    public function izmijeniAutora(Author $autor, AuthorService $autorService) {
        $viewName = $this->viewFolder . '.editAutor';

        $autorService->editAutor($autor);

        $viewModel = [
            'autor' => $autor
        ];

        return redirect('autori')->with('success', 'Autor je uspješno izmijenjen!');
    }

    /**
     * Izbrisi autora
     *
     * @param  Author $autor
     */
    public function izbrisiAutora(Author $autor) {
        Author::destroy($autor->id);

        return redirect('autori')->with('success', 'Autor je uspješno izbrisan!');
    }

    /**
     * Kreiraj i sacuvaj novog autora
     *
     * @param  AuthorService $autorService
     */
    public function sacuvajAutora(AuthorService $autorService) {

        $viewName = $this->viewFolder . '.autorProfile';

        $autor = $autorService->saveAutor();

        $viewModel = [
            'autor' => $autor
        ];

        return redirect('autori')->with('success', 'Autor je uspješno unesen!');
    }

    /**
     * Prikazi pretrazene autore
     *
     * @param  AuthorService $authorService
     * @return void
     */
    public function searchAutori(AuthorService $authorService) {

        $viewName = $this->viewFolder . '.autori';

        $autori = $authorService->searchAutori();

        $viewModel = [
            'autori' => $autori
        ];

        return view($viewName, $viewModel);
    }
}
