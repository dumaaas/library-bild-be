<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoryService {

    public function getCategories(){

        return $kategorije= DB::table('categories');
    }

    public function editCategory($kategorija){

        //request all data, validate and update category
        request()->validate([
         'nazivKategorijeEdit'=>'required',
         ]);

        $kategorija->name=request('nazivKategorijeEdit');
        $kategorija->description=request('opisKategorije');
        $kategorija->save();

   }
}