<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Book;

class BookService {
    public function getBooks() {
        return Book::all();
    }
}