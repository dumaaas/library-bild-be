<?php

namespace App\Http\Controllers;
use App\Models\Category;
use DB;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Services\UserService;

class CategoryController extends Controller
{

    private $viewFolder = 'pages/settings/categories';

    /**
     * Prikazi stranicu za editovanje kategorije
     *
     * @param  Category $kategorija
     * @return void
     */
    public function prikaziEditKategorija(Category $kategorija) {

        $viewName = $this->viewFolder . '.editKategorija';

        $viewModel = [
            'kategorija'=>$kategorija
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi sve kategorije
     *
     * @param  CategoryService $categoryService
     * @return void
     */
    public function prikaziSettingsKategorije(CategoryService $categoryService) {

        $viewName = $this->viewFolder . '.settingsKategorije';

        $viewModel = [
            'kategorije' => $categoryService->getCategories()->paginate(7)
        ];

        return view($viewName,$viewModel);
    }

    /**
     * Prikazi stranicu za unos nove kategorije
     *
     * @return void
     */
    public function prikaziNovaKategorija() {

        $viewName = $this->viewFolder . '.novaKategorija';

        return view($viewName);
    }

    /**
     * Kreiraj i sacuvaj novu kategoriju
     *
     * @param  CategoryService $categoryService
     * @param  UserService $userService
     * @param  Request $request
     */
    public function sacuvajKategoriju(CategoryService $categoryService, UserService $userService, Request $request) {

        $categoryService->saveCategory($userService, $request);

        //return back
        return redirect('settingsKategorije')->with('success', 'Kategorija uspjesno sacuvana!');
    }

    /**
     * Izmijeni podatke o kategoriji
     *
     * @param  Category $kategorija
     * @param  CategoryService $categoryService
     * @param  UserService $userService
     * @param  Request $request
     * @return void
     */
    public function izmijeniKategoriju(Category $kategorija, CategoryService $categoryService, UserService $userService, Request $request) {
        
        $categoryService->editCategory($kategorija, $userService, $request);

        //return back to the category
        return redirect('settingsKategorije')->with('success', 'Kategorija uspjesno izmjenjena!');
    }

    /**
     * Izbrisi kategoriju
     *
     * @param  Category $kategorija
     */
    public function izbrisiKategoriju(Category $kategorija) {
        Category::destroy($kategorija->id);
        return back()->with('success', 'Kategorija uspjesno izbrisana!');
    }
}
