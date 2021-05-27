<?php

namespace App\Http\Controllers;
use App\Models\Author;
use App\Services\AuthorService;
use DB;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    private $viewFolder = 'pages/autor';

    public function prikaziAutore(AuthorService $autorService) {

        $viewName = $this->viewFolder . '.autori';

        $viewModel = [
            'autori' => $autorService->getAutori()->paginate(7)
        ];

        return view($viewName, $viewModel);
    }

    public function prikaziAutora(Author $autor) {

        $viewName = $this->viewFolder . '.autorProfile';

        $viewModel = [
            'autor' => $autor
        ];

        return view($viewName, $viewModel);
    }

    public function prikaziEditAutor(Author $autor) {
        $viewName = $this->viewFolder . '.editAutor';

        return view($viewName, [
            'autor' => $autor
        ]);
    }

    public function prikaziNoviAutor() {
        $viewName = $this->viewFolder . '.noviAutor';

        return view($viewName);
    }

    public function izmijeniAutora(Author $autor, AuthorService $autorService) {
        $viewName = $this->viewFolder . '.editAutor';

        $autorService->editAutor($autor);

        //return back to the edit author form
        return view($viewName, [
            'autor' => $autor
        ]);
    }

    public function izbrisiAutora(Author $autor) {
        Author::destroy($autor->id);

        return back();
    }

    public function sacuvajAutora(AuthorService $autorService) {

        $viewName = $this->viewFolder . '.autorProfile';

        $autor = $autorService->saveAutor();

        //return back to the edit author form
        return view($viewName, [
            'autor' => $autor
        ]);
    }
}
