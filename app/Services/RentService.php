<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\RentStatus;
use App\Services\GlobalVariableService;
use Carbon\Carbon;
use Auth;

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
    public function getOverdueBooks() {
        
        $globalVariable = new GlobalVariableService();
        $period = $globalVariable->getOverdraftPeriod();

        return Rent::whereRaw('return_date + interval '. $period .' day < ?', [Carbon::now()])
                    ->where(function ($query) {
                        $query->select('statusBook_id')
                            ->from('rent_statuses')
                            ->whereColumn('rent_statuses.rent_id', 'rents.id')
                            ->orderByDesc('rent_statuses.date')
                            ->limit(1);
                    }, 2);
    }

    /**
     * Vrati sve izdate knjige
     *
     * @return void
     */
    public function getRentedBooks() {
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
    public function getReturnedBooks() {
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
     * Sacuvaj rent
     *
     * @param  Book  $book
     * @return void
     */
    public function saveRent($book) {
        $rent = new Rent();

        $rent->book_id = $book;
        $rent->librarian_id = Auth::id();
        $rent->student_id = request('student');
        $rent->rent_date = request('rentDate');
        $rent->return_date = request('returnDate');

        $rent->save();

        return $rent;
    }

    /**
     * Sacuvaj rent status
     *
     * @param  int $rentId
     * @param  date $rentDate
     * @return void
     */
    public function saveRentStatus($rentId, $rentDate) {
        $rentStatus = new RentStatus();

        $rentStatus->rent_id = $rentId;
        $rentStatus->statusBook_id = 2;
        $rentStatus->date = $rentDate;

        $rentStatus->save();
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

    /**
     * Vrati pretrazene izdate knjige
     *
     * @return void
     */
    public function searchIzdateKnjige() {
        $izdate = Rent::query();
        
        $izdate = $this->getIzdateKnjige();

        if(request('searchIzdate')) {
            $knjiga = request('searchIzdate');
            $izdate = $izdate->where(function ($query) {
                $query->select('title')
                    ->from('books')
                    ->whereColumn('books.id', 'rents.book_id');
            }, 'LIKE', '%'.$knjiga.'%');
        }

        $izdate = $izdate->paginate(7);

        return $izdate;
    }

    /**
     * Vrati pretrazene vracene knjige
     *
     * @return void
     */
    public function searchVraceneKnjige() {

        if(request('searchVracene')) {
            $knjiga = request('searchVracene');
            $vracene = Rent::where(function ($query) {
                $query->select('title')
                    ->from('books')
                    ->whereColumn('books.id', 'rents.book_id');
            }, 'LIKE', '%'.$knjiga.'%')
                ->where(function ($query) {
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

        $vracene = $vracene->paginate(7);

        return $vracene;
    }

    /**
     * Vrati pretrazene knjige u prekoracenju
     *
     * @return void
     */
    public function searchPrekoraceneKnjige() {

        $prekoracene = Rent::query();
        
        $prekoracene = $this->getPrekoraceneKnjige();

        if(request('searchPrekoracene')) {
            $knjiga = request('searchPrekoracene');
            $prekoracene = $prekoracene->where(function ($query) {
                $query->select('title')
                    ->from('books')
                    ->whereColumn('books.id', 'rents.book_id');
            }, 'LIKE', '%'.$knjiga.'%');
        }

        $prekoracene = $prekoracene->paginate(7);

        return $prekoracene;
    }
}