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
     * @param  Category $category
     * @return void
     */
    public function showEditCategory(Category $category) {

        $viewName = $this->viewFolder . '.editCategory';

        $viewModel = [
            'category'=>$category
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi sve kategorije
     *
     * @param  CategoryService $categoryService
     * @return void
     */
    public function showCategories(CategoryService $categoryService) {

        $viewName = $this->viewFolder . '.categories';

        $viewModel = [
            'categories' => $categoryService->getCategories()->paginate(7)
        ];

        return view($viewName,$viewModel);
    }

    /**
     * Prikazi stranicu za unos nove kategorije
     *
     * @return void
     */
    public function showAddCategory() {

        $viewName = $this->viewFolder . '.addCategory';

        return view($viewName);
    }

    /**
     * Kreiraj i sacuvaj novu kategoriju
     *
     * @param  CategoryService $categoryService
     * @param  UserService $userService
     * @param  Request $request
     */
    public function saveCategory(CategoryService $categoryService, UserService $userService, Request $request) {

        $categoryService->saveCategory($userService, $request);

        //return back
        return redirect('categories')->with('success', 'Kategorija je uspješno unesena!');
    }

    /**
     * Izmijeni podatke o kategoriji
     *
     * @param  Category $category
     * @param  CategoryService $categoryService
     * @param  UserService $userService
     * @param  Request $request
     * @return void
     */
    public function updateCategory(Category $category, CategoryService $categoryService, UserService $userService, Request $request) {
        
        $categoryService->editCategory($category, $userService, $request);

        //return back to all categories
        return redirect('categories')->with('success', 'Kategorija je uspješno izmijenjena!');
    }

    /**
     * Izbrisi kategoriju
     *
     * @param  Category $category
     */
    public function deleteCategory(Category $category) {
        Category::destroy($category->id);
        return back()->with('success', 'Kategorija je uspješno izbrisana!');
    }
}
