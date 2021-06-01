<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoryService {

    /**
     * Vrati sve kategorije iz baze podataka
     *
     * @return void
     */
    public function getCategories(){
        return $kategorije = DB::table('categories');
    }

    /**
     * Izvrsi validaciju podataka i edituj kategoriju
     *
     * @param  Category  $kategorija
     * @param  UserService $userService
     * @param  Request $request
     * @return void
     */
    public function editCategory($kategorija, $userService, $request){

        //request all data, validate and update category
        request()->validate([
            'nazivKategorijeEdit'     => 'string|max:256',
            'userImage'               => 'nullable|mimes:jpeg,png,jpg',
            'opisKategorijeEdit'      => 'nullable|string|max:2048'
        ]);

        $kategorija->name        = request('nazivKategorijeEdit');
        $kategorija->description = request('opisKategorijeEdit');

        $userService->uploadEditPhoto($kategorija, $request);

        $kategorija->save();
   }

   /**
     * Kreiraj novu kategoriju i sacuvaj je u bazi
     *
     * @param  UserService $userService
     * @param  Request $request
     * @return void
     */
   public function saveCategory($userService, $request) {
    //request all data, validate and update category
    request()->validate([
        'nazivKategorije' => 'required|string|max:256',
        'userImage'       => 'nullable|mimes:jpeg,png,jpg',
        'opisKategorije'  => 'nullable|string|max:2048',
    ]);

    $kategorija = new Category();

    $kategorija->name        = request('nazivKategorije');
    $kategorija->description = request('opisKategorije');

    $userService->uploadPhoto($kategorija, $request);

    $kategorija->save();
   }
}
