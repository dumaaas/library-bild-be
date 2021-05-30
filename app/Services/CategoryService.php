<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoryService {

    public function getCategories(){
        return $kategorije = DB::table('categories');
    }

    public function editCategory($kategorija, $userService, $request){

        //request all data, validate and update category
        request()->validate([
            'nazivKategorijeEdit'     => 'required|max:256',
            'userImage'           => 'image|nullable|max: 256',
            'opisKategorije'      => 'required|nullable|max:2048'
        ]);

        $kategorija->name        = request('nazivKategorijeEdit');
        $kategorija->description = request('opisKategorije');

        $userService->uploadEditPhoto($kategorija, $request);

        $kategorija->save();
   }

   public function saveCategory($userService, $request) {
    //request all data, validate and update category
    request()->validate([
        'nazivKategorije' => 'required|max:256',
        'userImage'       => 'image|nullable|max: 256',
        'opisKategorije'  => 'required|nullable|max:2048',
    ]);

    $kategorija = new Category();

    $kategorija->name        = request('nazivKategorije');
    $kategorija->description = request('opisKategorije');

    $userService->uploadPhoto($kategorija, $request);

    $kategorija->save();
   }
}