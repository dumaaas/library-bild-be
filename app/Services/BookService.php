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

use Auth; 

/*
|--------------------------------------------------------------------------
| BookService
|--------------------------------------------------------------------------
|
| RentService je odgovaran za svu logiku koja se desava 
| unutar BookControllera. Ovdje je moguce definisati sve 
| pomocne metode koji su potrebni.
|
*/

class BookService {

    /**
     * Vrati sve knjige
     *
     * @return void
     */
    public function getBooks() {
        return DB::table('books');
    }

    /**
     * Sacuvaj izdavanje knjige
     *
     * @param  Book $knjiga
     * @param  RentService $rentService
     * @param  ReservationService $reservationService
     * @return void
     */
    public function saveRent($knjiga, $rentService, $reservationService) {
        
        request()->validate([
            'ucenik'         => 'required',
            'datumIzdavanja' => 'required',
        ]);

        //sacuvaj izdavanje
        $izdavanje = $rentService->saveRent($knjiga);

        //promijeni status rezervacije u izdata i zatvori rezervaciju
        $rezervacija = $reservationService->getRezervacija($knjiga, $izdavanje->student_id);
        
        if($rezervacija != null) {
            $rezervacija->closeReservation_id = 4;
            $rezervacija->save();
    
            $reservationService->updateReservationStatus($rezervacija->id);
        }

        //dodavanje u tabelu rent_statuses
        $rentService->saveRentStatus($izdavanje->id, $izdavanje->rent_date);

        //update broj izdatih knjiga
        $izdataKnjiga = Book::find($knjiga);
        $updateIzdateKnjige = $izdataKnjiga->rentedBooks + 1;
        $izdataKnjiga->rentedBooks = $updateIzdateKnjige;
        
        if($rezervacija != null) {
            $izdataKnjiga->reservedBooks = $izdataKnjiga->reservedBooks-1;
        }
        
        $izdataKnjiga->save();
    }

    /**
     * Sacuvaj rezervaciju knjige
     *
     * @param  Book $knjiga
     * @param  ReservationService $reservationService
     * @return void
     */
    public function saveReservation($knjiga, $reservationService) {
        request()->validate([
            'ucenik'            => 'required',
            'datumRezervisanja' => 'required',
        ]);

        $rezervisanje = $reservationService->saveReservation($knjiga->id);

        //dodavanje u tabelu reservation_statuses
        $statusRezervisanja = $reservationService->saveReservationStatus($rezervisanje->id, $rezervisanje->reservation_date);

        //update broj rezervisanih knjiga
        $rezervisanaKnjiga = Book::find($knjiga->id);
        $rezervisanaKnjiga->reservedBooks = $rezervisanaKnjiga->reservedBooks + 1;
        $rezervisanaKnjiga->save();
    }

    /**
     * Sacuvaj knjigu
     *
     * @return void
     */
    public function saveBook() {
        $knjiga = new Book();

        $knjiga->title=request('nazivKnjiga');
        $knjiga->pages=request('brStrana');
        $knjiga->publishYear=request('godinaIzdavanja');
        $knjiga->ISBN=request('knjigaIsbn');
        $knjiga->quantity=request('knjigaKolicina');
        $knjiga->summary=request('kratki_sadrzaj');
        $knjiga->format_id=request('knjigaFormat');
        $knjiga->binding_id=request('knjigaPovez');
        $knjiga->script_id=request('knjigaPismo');
        $knjiga->publisher_id=request('knjigaIzdavac');
        $knjiga->language_id=request('knjigaJezik');


        $knjiga->save();

        return $knjiga;
    }

    /**
     * Sacuvaj kategorije za konkretnu knjigu
     *
     * @param Book $knjiga
     * @param Category $kategorija
     * @return void
     */
    public function saveBookCategories($knjiga, $kategorija) {
        $knjigaKategorije = new BookCategory();

        $knjigaKategorije->book_id = $knjiga;
        $knjigaKategorije->category_id = $kategorija;

        $knjigaKategorije->save();
    }

    /**
     * Sacuvaj zanrove za konkretnu knjigu
     *
     * @param Book $knjiga
     * @param Genre $zanr
     * @return void
     */
    public function saveBookGenres($knjiga, $zanr) {
        $knjigaZanrovi = new BookGenre();

        $knjigaZanrovi->book_id = $knjiga;
        $knjigaZanrovi->genre_id = $zanr;

        $knjigaZanrovi->save();
    }
    
    /**
     * Sacuvaj autore za konkretnu knjigu
     *
     * @param Book $knjiga
     * @param Author $autor
     * @return void
     */
    public function saveBookAuthors($knjiga, $autor) {
        $knjigaAutori = new BookAuthor();

        $knjigaAutori->book_id = $knjiga;
        $knjigaAutori->author_id = $autor;

        $knjigaAutori->save();
    }
}