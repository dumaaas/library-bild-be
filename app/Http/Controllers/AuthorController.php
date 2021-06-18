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

    private $viewFolder = 'pages/authors';

    /**
     * Prikazi sve autore
     *
     * @param  AuthorService $authorService
     * @return void
     */
    public function showAuthors(AuthorService $authorService) {

        $viewName = $this->viewFolder . '.authors';

        $viewModel = [
            'authors' => $authorService->getAuthors()->paginate(7)
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi konkretnog autora
     *
     * @param  Author $auhtor
     * @return void
     */
    public function showAuthor(Author $author) {

        $viewName = $this->viewFolder . '.authorProfile';

        $viewModel = [
            'author' => $author
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi stranicu za editovanje autora
     *
     * @param  Author $author
     * @return void
     */
    public function showEditAuthor(Author $author) {
        $viewName = $this->viewFolder . '.editAuthor';

        $viewModel = [
            'author' => $author
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi stranicu za unos novog autora
     *
     * @return void
     */
    public function showAddAuthor() {
        $viewName = $this->viewFolder . '.addAuthor';

        return view($viewName);
    }

    /**
     * Izmijeni podatke o autoru
     *
     * @param  Author $author
     * @param  AuthorService $authorService
     * @return void
     */
    public function updateAuthor(Author $author, AuthorService $authorService) {
        $viewName = $this->viewFolder . '.editAuthor';

        $authorService->editAuthor($author);

        $viewModel = [
            'author' => $author
        ];

        return redirect('authors')->with('success', 'Autor je uspješno izmijenjen!');
    }

    /**
     * Izbrisi autora
     *
     * @param  Author $author
     */
    public function deleteAuthor(Author $author) {
        Author::destroy($author->id);

        return redirect('authors')->with('success', 'Autor je uspješno izbrisan!');
    }

    /**
     * Kreiraj i sacuvaj novog autora
     *
     * @param  AuthorService $authorService
     */
    public function saveAuthor(AuthorService $authorService) {

        $viewName = $this->viewFolder . '.authorProfile';

        $author = $authorService->saveAuthor();

        $viewModel = [
            'author' => $author
        ];

        return redirect('authors')->with('success', 'Autor je uspješno unesen!');
    }

    /**
     * Prikazi pretrazene autore
     *
     * @param  AuthorService $authorService
     * @return void
     */
    public function searchAuthors(AuthorService $authorService) {

        $viewName = $this->viewFolder . '.authors';

        $authors = $authorService->searchAuthors();

        $viewModel = [
            'authors' => $authors
        ];

        return view($viewName, $viewModel);
    }
}
