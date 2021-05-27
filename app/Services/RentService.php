<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Rent;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| RentService
|--------------------------------------------------------------------------
|
| RentService je odgovaran za svu logiku koja se desava 
| unutar RentControllera. Ovdje je moguce definisati sve 
| pomocne metode koji su potrebni.
|
*/

class RentService 
{
    /**
     * Vrati trazenu transakciju
     *
     * @param  Book  $knjiga
     * @param  User  $ucenik
     * @return void
     */
    public function getTransakcija($knjiga, $ucenik) {
        return Rent::with('book', 'student', 'librarian')
                    ->where('book_id', '=', $knjiga)
                    ->where('student_id', '=', $ucenik)
                    ->first();
    }

    /**
     * Vrati sve knjige u prekoracenju
     *
     * @return void
     */
    public function getPrekoraceneKnjige() {
        return Rent::where('return_date', '<', Carbon::now())
                    ->where(function ($query) {
                        $query->select('statusBook_id')
                            ->from('rent_statuses')
                            ->whereColumn('rent_statuses.rent_id', 'rents.id')
                            ->orderByDesc('rent_statuses.date')
                            ->limit(1);
                    }, 2);
    }

    /**
     * Vrati sveizdate knjige
     *
     * @return void
     */
    public function getIzdateKnjige() {
        return Rent::where(function ($query) {
                        $query->select('statusBook_id')
                            ->from('rent_statuses')
                            ->whereColumn('rent_statuses.rent_id', 'rents.id')
                            ->orderByDesc('rent_statuses.date')
                            ->limit(1);
                    }, 2);
    }

    /**
     * Vrati sve vracene knjige
     *
     * @return void
     */
    public function getVraceneKnjige() {
        return Rent::where(function ($query) {
                        $query->select('statusBook_id')
                            ->from('rent_statuses')
                            ->whereColumn('rent_statuses.rent_id', 'rents.id')
                            ->orderByDesc('rent_statuses.date')
                            ->limit(1);
                    }, 1)->orWhere(function ($query) {
                            $query->select('statusBook_id')
                                ->from('rent_statuses')
                                ->whereColumn('rent_statuses.rent_id', 'rents.id')
                                ->orderByDesc('rent_statuses.date')
                                ->limit(1);
                    }, 3);
    }

    /**
     * Izbrisi transakciju
     *
     * @param  Book  $knjiga
     * @param  User  $ucenik
     * @return void
     */
    public function deleteTransakcija($knjiga, $ucenik) {
        $transakcija = $this->getTransakcija($knjiga, $ucenik);
            
        Rent::destroy($transakcija->id);
    }

    /**
     * Vrati filtrirane izdate knjige
     *
     * @return void
     */
    public function filtirajIzdateKnjige() {
        $izdate = Rent::query();
        $izdate = $izdate->with('book', 'student', 'librarian')
                        ->where('return_date', '=', null);

        if(request('uceniciFilter')) {
            $ucenici = request('uceniciFilter');
            $izdate  = $izdate->whereIn('student_id', $ucenici);
        }

        if(request('bibliotekariFilter')) {
            $bibliotekari = request('bibliotekariFilter');
            $izdate       = $izdate->whereIn('librarian_id', $bibliotekari);
        }

        if(request('filterDatumOd') && request('filterDatumDo')) {
            $datumOd = request('filterDatumOd');
            $datumDo = request('filterDatumDo');
            $izdate  = $izdate->whereBetween('rent_date', [$datumOd, $datumDo]);
        }

        $izdate = $izdate->paginate(7);

        return $izdate;
    }

    /**
     * Vrati filtrirane vracene knjige
     *
     * @return void
     */
    public function filtirajVraceneKnjige() {
        $vracene = Rent::query();
        $vracene = $vracene->with('book', 'student', 'librarian')
                        ->where('return_date', '!=', null);

        if(request('uceniciFilter')) {
            $ucenici = request('uceniciFilter');
            $vracene = $vracene->whereIn('student_id', $ucenici);
        }

        if(request('bibliotekariFilter')) {
            $bibliotekari = request('bibliotekariFilter');
            $vracene      = $vracene->whereIn('librarian_id', $bibliotekari);
        }

        if(request('filterDatumOd') && request('filterDatumDo')) {
            $datumOd = request('filterDatumOd');
            $datumDo = request('filterDatumDo');
            $vracene = $vracene->whereBetween('rent_date', [$datumOd, $datumDo]);
        }

        if(request('filterVracenaOd') && request('filterVracenaDo')) {
            $vracenaOd = request('filterVracenaOd');
            $vracenaDo = request('filterVracenaDo');
            $vracene   = $vracene->whereBetween('return_date', [$vracenaOd, $vracenaDo]);
        }

        $vracene = $vracene->paginate(7);

        return $vracene;
    }

    /**
     * Vrati filtrirane knjige u prekoracenju
     *
     * @return void
     */
    public function filtirajPrekoraceneKnjige() {
        $prekoracene = Rent::query();
        $prekoracene = $prekoracene->with('book', 'student', 'librarian')
                            ->where('return_date', '=', null)
                            ->where('rent_date', '<', Carbon::now()->subDays(30));

        if(request('uceniciFilter')) {
            $ucenici     = request('uceniciFilter');
            $prekoracene = $prekoracene->whereIn('student_id', $ucenici);
        }

        if(request('filterDatumOd') && request('filterDatumDo')) {
            $datumOd     = request('filterDatumOd');
            $datumDo     = request('filterDatumDo');
            $prekoracene = $prekoracene->whereBetween('rent_date', [$datumOd, $datumDo]);
        }

        $prekoracene = $prekoracene->paginate(7);

        return $prekoracene;
    }
}