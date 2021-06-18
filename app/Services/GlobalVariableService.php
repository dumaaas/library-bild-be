<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Rent;
use App\Models\RentStatus;
use App\Models\BookCategory;
use App\Models\BookGenre;
use App\Models\BookAuthor;
use Carbon\Carbon;
use Auth;

/*
|--------------------------------------------------------------------------
| GlobalVariableService
|--------------------------------------------------------------------------
|
| GlobalVariableService sadrzi sve globalne varijable
|
*/

class GlobalVariableService {

    /**
     * Vrati rok izdavanja
     *
     * @return void
     */
    public function getRokIzdavanja() {
        $rok =  DB::table('global_variables')->where('id', '=', 1)->first();

        return $rok->value;
    }

    /**
     * Vrati rok rezervacije
     *
     * @return void
     */
    public function getRokRezervacije() {
        $rok = DB::table('global_variables')->where('id', '=', 2)->first();

        return $rok->value;
    }

    /**
     * Vrati rok prekoracenja
     *
     * @return void
     */
    public function getOverdraftPeriod() {
        $period = DB::table('global_variables')->where('id', '=', 3)->first();

        return $period->value;
    }

}
