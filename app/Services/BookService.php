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
use App\Models\Galery;
use Carbon\Carbon;
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
            'datumVracanja'  => 'required',
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
    public function saveReservation($knjiga, $reservationService, $globalVariableService) {
        request()->validate([
            'ucenik'            => 'required',
            'datumRezervisanja' => 'required',
        ]);

        $rezervisanje = $reservationService->saveReservation($knjiga->id, $globalVariableService);

        //dodavanje u tabelu reservation_statuses
        $reservationService->saveReservationStatus($rezervisanje->id, $rezervisanje->reservation_date);

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
    public function saveBookCategories($kategorijeValues, $knjiga) {
        $kategorije = explode(',', $kategorijeValues);

        foreach($kategorije as $kategorija) {
            $knjigaKategorije = new BookCategory();

            $knjigaKategorije->book_id = $knjiga;
            $knjigaKategorije->category_id = $kategorija;

            $knjigaKategorije->save();
       }
    }

    /**
     * Sacuvaj zanrove za konkretnu knjigu
     *
     * @param Book $knjiga
     * @param Genre $zanr
     * @return void
     */
    public function saveBookGenres($zanroviValues, $knjiga) {
        $zanrovi = explode(',', $zanroviValues);

        foreach($zanrovi as $zanr) {
            $knjigaZanrovi = new BookGenre();

            $knjigaZanrovi->book_id = $knjiga;
            $knjigaZanrovi->genre_id = $zanr;

            $knjigaZanrovi->save();
        }
    }

    /**
     * Sacuvaj autore za konkretnu knjigu
     *
     * @param Book $knjiga
     * @param Author $autor
     * @return void
     */
    public function saveBookAuthors($autoriValues, $knjiga) {
        $autori = explode(',', $autoriValues);

        foreach($autori as $autor) {
            $knjigaAutori = new BookAuthor();

            $knjigaAutori->book_id = $knjiga;
            $knjigaAutori->author_id = $autor;

            $knjigaAutori->save();
        }

    }

    /**
     * Vrati trazene autore
     *
     * @return void
     */
    public function filterAutori() {
        $knjige = Book::query();
        $knjige = $knjige->with('author', 'category');

        if(request('autoriFilter')) {
            $autori = request('autoriFilter');
            foreach($autori as $autor) {
                $knjige->whereHas('author', function($q) use ($autor) {
                    $q->where('author_id', $autor);
                });
            }
        }

        if(request('kategorijeFilter')) {
            $kategorije = request('kategorijeFilter');
            foreach($kategorije as $kategorija) {
                $knjige->whereHas('category', function($q) use ($kategorija) {
                    $q->where('category_id', $kategorija);
                });
            }
        }

        return $knjige;
    }

    /**
     * Sacuvaj vracanje knjiga
     *
     * @return void
     */
    public function vratiKnjige($globalVariableService) {
        $knjige=request('vratiKnjigu');

        foreach($knjige as $knjiga){
            $rent=Rent::find($knjiga);

            $rent->librarian_received_id = Auth::user()->id;
            $rent->save();

            $rentStatus=new RentStatus();
            $rentStatus->rent_id=$rent->id;

            if($rent->rent_date<Carbon::now()->subDays($globalVariableService->getRokIzdavanja() + $globalVariableService->getRokPrekoracenja())){
                $rentStatus->statusBook_id=3;
            }
            else{
                $rentStatus->statusBook_id=1;
            }

            $rentStatus->date=Carbon::now();
            $rentStatus->save();

            $book=Book::find($rent->book_id);
            $book->rentedBooks=$book->rentedBooks-1;
            $book->save();
        }
    }

    /**
     * Sacuvaj otpisivanje knjiga
     *
     * @return void
     */
    public function otpisiKnjige() {
        $knjige=request('otpisiKnjigu');

        foreach($knjige as $knjiga){
            $rent=Rent::find($knjiga);
            $book=Book::find($rent->book_id);
            $book->rentedBooks=$book->rentedBooks-1;
            $book->quantity=$book->quantity-1;
            $book->save();
            Rent::destroy($rent->id);
        }
    }

    /**
     * Vrati pretrazene knjige
     *
     * @return void
     */
    public function searchKnjige() {

        $knjige = Book::query();

        if(request('searchKnjige')) {
            $knjigaPretraga = request('searchKnjige');
            $knjige = $knjige->where('title', 'LIKE', '%'.$knjigaPretraga.'%');
        }

        $knjige = $knjige->paginate(7);

        return $knjige;
    }

    public function uploadBookImages($knjiga, $request) {
        if ($request->hasFile('movieImages')) {
            $movieImages = $request->file('movieImages');
            $coverImage = request('imageCover');

            foreach($movieImages as $movieImage) {

                $filenameWithExt = $movieImage->getClientOriginalName();
                // Get Filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just Extension
                $extension = $movieImage->getClientOriginalExtension();
                // Filename To store
                $fileNameToStore = $filename. '_'. time().'.'.$extension;
                // Upload Image
                $path = $movieImage->storeAs('public/image', $fileNameToStore);

                // Save image in Galery
                $galery = new Galery();

                $galery->book_id = $knjiga;
                $galery->photo = $fileNameToStore;

                if($movieImages[$coverImage] == $movieImage) {
                    $galery->cover = 1;
                }

                $galery->save();
            }
        }
    }

    public function editBookImages($knjiga, $request) {
        if ($request->hasFile('movieImages')) {
            $movieImages = $request->file('movieImages');
            $coverImage = request('imageCover');
            foreach($movieImages as $movieImage) {

                $filenameWithExt = $movieImage->getClientOriginalName();
                // Get Filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just Extension
                $extension = $movieImage->getClientOriginalExtension();
                // Filename To store
                $fileNameToStore = $filename. '_'. time().'.'.$extension;
                // Upload Image
                $path = $movieImage->storeAs('public/image', $fileNameToStore);

                // Save image in Galery
                $galery = new Galery();

                $galery->book_id = $knjiga;
                $galery->photo = $fileNameToStore;

                if($movieImages[$coverImage] == $movieImage) {
                    $galery->cover = 1;
                }

                $galery->save();
            }
        }
    }

    // public function getCoverImage($knjiga) {
    //     return Galery::where('book_id', '=', $knjiga)
    //                         ->where('cover', '=', 1)
    //                         ->first();
    // }
}
