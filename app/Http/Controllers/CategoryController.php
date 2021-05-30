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

    public function prikaziEditKategorija(Category $kategorija) {

        $viewName = $this->viewFolder . '.editKategorija';

        $viewModel = [
            'kategorija'=>$kategorija
        ];

        return view($viewName, $viewModel);
    }
    public function prikaziSettingsKategorije(CategoryService $categoryService) {

        $viewName = $this->viewFolder . '.settingsKategorije';

        $viewModel = [
            'kategorije' => $categoryService->getCategories()->paginate(7)
        ];

        return view($viewName,$viewModel);
    }
    public function prikaziNovaKategorija() {

        $viewName = $this->viewFolder . '.novaKategorija';

        return view($viewName);
    }

    public function sacuvajKategoriju(CategoryService $categoryService, UserService $userService, Request $request) {
        
        $categoryService->saveCategory($userService, $request);

        //return back
        return back()->with('success', 'Kategorija uspjesno sacuvana!');
    }

    public function izmijeniKategoriju(Category $kategorija, CategoryService $categoryService, UserService $userService, Request $request) {
       
        $viewName = $this->viewFolder . '.editKategorija';

        $viewModel = [
            'kategorija' => $kategorija
        ];

        $categoryService->editCategory($kategorija, $userService, $request);

        //return back to the category
        return view($viewName,$viewModel);
    }

    public function izbrisiKategoriju(Category $kategorija) {
        Category::destroy($kategorija->id);
        return back();
    }
}
