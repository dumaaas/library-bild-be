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
     * @param  Book $book
     * @param  RentService $rentService
     * @param  ReservationService $reservationService
     * @return void
     */
    public function saveRent($book, $rentService, $reservationService) {

        request()->validate([
            'student'         => 'required',
            'rentDate' => 'required',
            'returnDate'  => 'required',
        ]);

        //sacuvaj izdavanje
        $rent = $rentService->saveRent($book);

        //promijeni status rezervacije u izdata i zatvori rezervaciju
        $reservation = $reservationService->getReservation($book, $rent->student_id);

        if($reservation != null) {
            $reservation->closeReservation_id = 4;
            $reservation->save();

            $reservationService->updateReservationStatus($reservation->id);
        }

        //dodavanje u tabelu rent_statuses
        $rentService->saveRentStatus($rent->id, $rent->rent_date);

        //update broj izdatih knjiga
        $rentedBook = Book::find($book);
        $updateRentedBook = $rentedBook->rentedBooks + 1;
        $rentedBook->rentedBooks = $updateRentedBook;

        if($reservation != null) {
            $rentedBook->reservedBooks = $rentedBook->reservedBooks-1;
        }

        $rentedBook->save();
    }

    /**
     * Sacuvaj rezervaciju knjige
     *
     * @param  Book $book
     * @param  ReservationService $reservationService
     * @param  GlobalVariableService $globalVariableService
     * @return void
     */
    public function saveReservation($book, $reservationService, $globalVariableService) {
        request()->validate([
            'student'         => 'required',
            'reservationDate' => 'required',
        ]);

        $reservation = $reservationService->saveReservation($book->id, $globalVariableService);

        //dodavanje u tabelu reservation_statuses
        $reservationService->saveReservationStatus($reservation->id, $reservation->reservation_date);

        //update broj rezervisanih knjiga
        $reservedBook = Book::find($book->id);
        $reservedBook->reservedBooks = $reservedBook->reservedBooks + 1;
        $reservedBook->save();
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
     * @param GlobalVariableServis $globalVariableService
     * @return void
     */
    public function returnBooks($globalVariableService) {
        $knjige=request('vratiKnjigu');

        foreach($knjige as $knjiga){
            $rent=Rent::find($knjiga);

            $rent->librarian_received_id = Auth::user()->id;
            $rent->save();

            $rentStatus=new RentStatus();
            $rentStatus->rent_id=$rent->id;

            if($rent->rent_date<Carbon::now()->subDays($globalVariableService->getReturnDueDate() + $globalVariableService->getOverdraftPeriod())){
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

    /**
     * Vrati pretrazene ucenike od kojih se vraca knjiga
     *
     * @return void
     */
    public function searchReturnBook(Book $book, RentService $rentService) {
        $rentedBooks = Rent::query();
        if(request('searchReturn')) {
            $searchedStudent = request('searchReturn');
            $rentedBooks = $rentService->getRentedBooks()
                            ->where('book_id', '=', $book->id)
                            ->where(function ($query) {
                                $query->select('name')
                                    ->from('users')
                                    ->whereColumn('users.id', 'rents.student_id');
                            }, 'LIKE', '%'.$searchedStudent.'%');
        }else{
            $rentedBooks = $rentService->getRentedBooks()
                            ->where('book_id', '=', $book->id);
        }

        $rentedBooks = $rentedBooks->paginate(7);

        return $rentedBooks;
    }

    /**
     * Vrati pretrazene ucenike od kojih se otpisuje knjiga
     *
     * @return void
     */
    public function searchOtpisiKnjige(Book $knjiga, RentService $rentService) {
        $otpisiKnjige = Rent::query();
        if(request('searchOtpisi')) {
            $ucenikPretraga = request('searchOtpisi');
            $otpisiKnjige = $rentService->getPrekoraceneKnjige()
                            ->where('book_id', '=', $knjiga->id)
                            ->where(function ($query) {
                                $query->select('name')
                                    ->from('users')
                                    ->whereColumn('users.id', 'rents.student_id');
                            }, 'LIKE', '%'.$ucenikPretraga.'%');
        }else{
            $otpisiKnjige = $rentService->getPrekoraceneKnjige()
                            ->where('book_id', '=', $knjiga->id);
        }

        $otpisiKnjige = $otpisiKnjige->paginate(7);

        return $otpisiKnjige;
    }

    // public function getCoverImage($knjiga) {
    //     return Galery::where('book_id', '=', $knjiga)
    //                         ->where('cover', '=', 1)
    //                         ->first();
    // }
}
