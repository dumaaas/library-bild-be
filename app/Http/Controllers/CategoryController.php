<?php

namespace App\Http\Controllers;
use App\Models\Category;
use DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    private $viewFolder = 'pages/settings/categories';

    public function prikaziEditKategorija(Category $kategorija) {

        $viewName = $this->viewFolder . '.editKategorija';

        return view($viewName, [
        'kategorija'=>$kategorija
        ]);
    }
    public function prikaziSettingsKategorije() {

        $viewName = $this->viewFolder . '.settingsKategorije';

        return view($viewName,[
            'kategorije'=>DB::table('categories')->paginate(7)
        ]);
    }
    public function prikaziNovaKategorija() {

        $viewName = $this->viewFolder . '.novaKategorija';

        return view($viewName);
    }

    public function sacuvajKategoriju() {
        //request all data, validate and update category
        request()->validate([
            'nazivKategorije'=>'required',
        ]);

        $kategorija = new Category();

        $kategorija->name=request('nazivKategorije');
        $kategorija->description=request('opisKategorije');
        $kategorija->save();

        //return back
        return back();
    }

    public function izmijeniKategoriju(Category $kategorija) {
        //request all data, validate and update category
        request()->validate([
            'nazivKategorijeEdit'=>'required',
        ]);

        $kategorija->name=request('nazivKategorijeEdit');
        $kategorija->description=request('opisKategorije');
        $kategorija->save();

        //return back to the category
        return view('editKategorija', [
            'kategorija' => $kategorija
        ]);
    }

    public function izbrisiKategoriju(Category $kategorija) {
        Category::destroy($kategorija->id);
        return back();
    }
}
