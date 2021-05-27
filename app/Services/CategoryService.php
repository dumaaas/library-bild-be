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
}