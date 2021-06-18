<?php

namespace App\Http\Controllers;

use App\Services\GlobalVariableService;
use DB;
use App\Models\Book;
use App\Models\Author;
use App\Models\BookAuthor;
use App\Models\Category;
use App\Models\BookCategory;
use App\Models\BookGenre;
use App\Models\Rent;
use App\Models\Galery;
use App\Models\RentStatus;
use App\Models\Reservation;
use App\Models\ReservationStatus;
use App\Models\GlobalVariable;
use App\Services\AuthorService;
use App\Services\BookService;
use App\Services\DashboardService;
use App\Services\RentService;
use App\Services\UserService;
use App\Services\CategoryService;
use App\Services\ReservationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| BookController
|--------------------------------------------------------------------------
|
| BookController je odgovaran za povezivanje logike
| izmedju book view-a i neophodnih Modela
|
*/

class BookController extends Controller
{
    private $viewFolder = 'pages/books';

    /**
     * Prikazi stranicu za editovanje knjige
     *
     * @param  Book $knjiga
     * @return void
     */
    public function prikaziEditKnjiga(Book $knjiga) {
        $viewName = $this->viewFolder . '.editKnjiga';

        $viewModel = [
            'knjiga'     => $knjiga,
            'kategorije' => DB::table('categories')->get(),
            'zanrovi'    => DB::table('genres')->get(),
            'autori'     => DB::table('authors')->get(),
            'izdavaci'   => DB::table('publishers')->get(),
            'pisma'      => DB::table('scripts')->get(),
            'povezi'     => DB::table('bindings')->get(),
            'formati'    => DB::table('formats')->get(),
            'jezici'     => DB::table('languages')->get(),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi sve knjige
     *
     * @param  AuthorService $autorService
     * @return void
     */
    public function prikaziEvidencijaKnjiga(AuthorService $autorService) {
        $viewName = $this->viewFolder . '.evidencijaKnjiga';

        $viewModel = [
            'knjige'     => Book::paginate(7),
            'autori'     => $autorService->getAutori()->get(),
            'kategorije' => Category::all(),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi stranicu sa multimedijom kod konkretne knjige
     *
     * @param  Book $knjiga
     * @param  DashboardService $dashboardService
     * @return void
     */
    public function prikaziEvidencijaKnjigaMultimedija(Book $knjiga, DashboardService $dashboardService) {
        $viewName = $this->viewFolder . '.evidencijaKnjigaMultimedija';

        $viewModel = [
            'knjiga'     => $knjiga,
            'aktivnosti' => $dashboardService->getBookActivity($knjiga->id)
                                ->take(3)
                                ->get(),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi stranicu sa osnovnim detaljima konkretne knjige
     *
     * @param  Book $book
     * @param  DashboardService $dashboardService
     * @return void
     */
    public function showBookDetails(Book $book, DashboardService $dashboardService) {
        $viewName = $this->viewFolder . '.bookDetails';

        $viewModel = [
            'book'     => $book,
            'activities' => $dashboardService->getBookActivity($book->id)
                                                    ->take(3)
                                                    ->get(),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi stranicu sa specifikacijama konkretne knjige
     *
     * @param  Book $book
     * @param  DashboardService $dashboardService
     * @return void
     */
    public function showBookSpecification(Book $book, DashboardService $dashboardService) {
        $viewName = $this->viewFolder . '.bookSpecification';

        $viewModel = [
            'book'     => $book,
            'activities' => $dashboardService->getBookActivity($book->id)
                                ->take(3)
                                ->get(),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi stranicu sa specifikacijama konkretne knjige
     *
     * @param  Book $knjiga
     * @param  DashboardService $dashboardService
     * @return void
     */
    public function prikaziNovaKnjiga(AuthorService $autorService) {
        $viewName = $this->viewFolder . '.novaKnjiga';

        $viewModel = [
            'kategorije' => DB::table('categories')->get(),
            'zanrovi'    => DB::table('genres')->get(),
            'autori'     => $autorService->getAutori()->get(),
            'izdavaci'   => DB::table('publishers')->get(),
            'pisma'      => DB::table('scripts')->get(),
            'povezi'     => DB::table('bindings')->get(),
            'formati'    => DB::table('formats')->get(),
            'jezici'     => DB::table('languages')->get(),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi stranicu za vracanje knjige
     *
     * @param  Book $book
     * @param  RentService $rentService
     * @return void
     */
    public function showReturnBook(Book $book, RentService $rentService) {
        $viewName = $this->viewFolder . '.returnBook';

        $rentedBooks = $rentService->getRentedBooks()
                            ->where('book_id', '=', $book->id)
                            ->paginate(7);

        $viewModel = [
            'book'      => $book,
            'rentedBooks' => $rentedBooks,
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi stranicu za otpis knjige
     *
     * @param  Book $book
     * @param  RentService $rentService
     * @return void
     */
    public function showWriteOffBook(Book $book, RentService $rentService) {
        $viewName = $this->viewFolder . '.writeOffBook';

        $overdueBooks = $rentService->getOverdueBooks()
                            ->where('book_id', '=', $book->id)
                            ->paginate(7);

        $viewModel = [
            'book'       => $book,
            'overdueBooks' => $overdueBooks
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi stranicu za rezervisanje knjige
     *
     * @param  Book $book
     * @param  UserService $userService
     * @param  RentService $rentService
     * @return void
     */
    public function showReserveBook(Book $book, UserService $userService, RentService $rentService) {
        $viewNameReserve = $this->viewFolder . '.reserveBook';
        $viewNameError = $this->viewFolder . '.rentBookError';

        $availableBooks = $book->quantity - $book->rentedBooks - $book->reservedBooks;

        $viewModelReserve = [
            'book'  => $book,
            'students' => $userService->getStudents()->get(),
        ];

        $viewModelError = [
            'book'         => $book,
            'overdueBooks' => $rentService->getOverdueBooks()
                                        ->where('book_id', '=', $book->id)
                                        ->get()
        ];

        if($availableBooks > 0) {
            return view($viewNameReserve, $viewModelReserve);
        } else {
            return view($viewNameError, $viewModelError);
        }
    }

    /**
     * Prikazi stranicu za izdavanje knjige
     *
     * @param  Book $book
     * @param  UserService $userService
     * @param  RentService $rentService
     * @return void
     */
    public function showRentBook(Book $book, UserService $userService, RentService $rentService) {
        $viewNameRent = $this->viewFolder . '.rentBook';
        $viewNameError = $this->viewFolder . '.rentBookError';

        $availableBooks = $book->quantity - $book->rentedBooks - $book->reservedBooks;

        $viewModelRent = [
            'book'          => $book,
            'students'      => $userService->getStudents()->get(),
            'returnDueDate' => GlobalVariable::find(1),
            'overdueBooks'  => $rentService->getOverdueBooks()
                                        ->where('book_id', '=', $book->id)
                                        ->get(),
        ];

        $viewModelError = [
            'book'         => $book,
            'overdueBooks' => $rentService->getOverdueBooks()
                                        ->where('book_id', '=', $book->id)
                                        ->get(),
        ];

        if($availableBooks > 0) {
            return view($viewNameRent, $viewModelRent);
        } else {
            return view($viewNameError, $viewModelError);
        }
    }

    /**
     * Izdaj knjigu
     *
     * @param  Book $book
     * @param  BookService $bookService
     * @param  RentService $rentService
     * @param  ReservationService $reservationService
     * @return void
     */
    public function rent(Book $book, BookService $bookService, RentService $rentService, ReservationService $reservationService) {

        $bookService->saveRent($book->id, $rentService, $reservationService);

        return back()->with('success', 'Knjiga je uspješno izdata!');
    }

    /**
     * Rezervisi knjigu
     *
     * @param  Book $book
     * @param  BookService $bookService
     * @param  ReservationService $reservationService
     * @param  GlobalVariableService $globalVariableService
     * @return void
     */
    public function reserve(Book $book, BookService $bookService, ReservationService $reservationService, GlobalVariableService $globalVariableService) {

        $bookService->saveReservation($book, $reservationService, $globalVariableService);

        return back()->with('success', 'Knjiga je uspješno rezervisana!');
    }

    /**
     * Prikazi izdate knjige kod konkretne knjige
     *
     * @param  Book $knjiga
     * @param  DashboardService $dashboardService
     * @param  RentService $rentService
     * @return void
     */
    public function prikaziIznajmljivanjeIzdate(Book $knjiga, DashboardService $dashboardService, RentService $rentService) {
        $viewName = $this->viewFolder . '.iznajmljivanjeIzdate';

        $viewModel = [
            'knjiga'               => $knjiga,
            'aktivnosti'           => $dashboardService->getBookActivity($knjiga->id)
                                            ->take(3)
                                            ->get(),
            'iznajmljivanjeIzdate' => $rentService->getIzdateKnjige()
                                            ->where('book_id', '=', $knjiga->id)
                                            ->paginate(7),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi knjige u prekoracenju kod konkretne knjige
     *
     * @param  Book $knjiga
     * @param  DashboardService $dashboardService
     * @param  RentService $rentService
     * @return void
     */
    public function prikaziIznajmljivanjePrekoracenje(Book $knjiga, DashboardService $dashboardService, RentService $rentService) {
        $viewName = $this->viewFolder . '.iznajmljivanjePrekoracenje';

        $viewModel = [
            'knjiga'                    => $knjiga,
            'aktivnosti'                => $dashboardService->getBookActivity($knjiga->id)
                                                ->take(3)
                                                ->get(),
            'iznajmljivanjePrekoracene' => $rentService->getPrekoraceneKnjige()
                                                ->where('book_id', '=', $knjiga->id)
                                                ->paginate(7),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi vracene knjigekod konkretne knjige
     *
     * @param  Book $knjiga
     * @param  DashboardService $dashboardService
     * @param  RentService $rentService
     * @return void
     */
    public function prikaziIznajmljivanjeVracene(Book $knjiga, DashboardService $dashboardService) {
        $viewName = $this->viewFolder . '.iznajmljivanjeVracene';

        $iznajmljivanjeV = Rent::where('book_id', '=', $knjiga->id)
                                    ->where(function ($query) {
                                    $query->select('statusBook_id')
                                        ->from('rent_statuses')
                                        ->whereColumn('rent_statuses.rent_id', 'rents.id')
                                        ->orderByDesc('rent_statuses.date')
                                        ->limit(1);
                                    }, 1);
        $iznajmljivanjeVracene = Rent::where('book_id', '=', $knjiga->id)
                                    ->where(function ($query) {
                                    $query->select('statusBook_id')
                                        ->from('rent_statuses')
                                        ->whereColumn('rent_statuses.rent_id', 'rents.id')
                                        ->orderByDesc('rent_statuses.date')
                                        ->limit(1);
                                    }, 3)->union($iznajmljivanjeV);
        $viewModel = [
            'knjiga'                => $knjiga,
            'aktivnosti'            => $dashboardService->getBookActivity($knjiga->id)
                                            ->take(3)
                                            ->get(),
            'iznajmljivanjeVracene' => $iznajmljivanjeVracene->paginate(7),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi aktivne rezervacije konkretne knjige
     *
     * @param  Book $knjiga
     * @param  DashboardService $dashboardService
     * @param  ReservationService $reservationService
     * @return void
     */
    public function prikaziIznajmljivanjeAktivne(Book $knjiga, DashboardService $dashboardService, ReservationService $reservationService) {
        $viewName = $this->viewFolder . '.iznajmljivanjeAktivne';

        $viewModel = [
            'knjiga'                => $knjiga,
            'aktivnosti'            => $dashboardService->getBookActivity($knjiga->id)
                                            ->take(3)
                                            ->get(),

            'iznajmljivanjeAktivne' => $reservationService->getAktivneRezervacije()
                                            ->where('book_id', '=', $knjiga->id)
                                            ->paginate(7),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi arhivirane rezervacije konkretne knjige
     *
     * @param  Book $knjiga
     * @param  DashboardService $dashboardService
     * @param  ReservationService $reservationService
     * @return void
     */
    public function prikaziIznajmljivanjeArhivirane(Book $knjiga, DashboardService $dashboardService, ReservationService $reservationService) {
        $viewName = $this->viewFolder . '.iznajmljivanjeArhivirane';

        $viewModel = [
            'knjiga'                   => $knjiga,
            'aktivnosti'               => $dashboardService->getBookActivity($knjiga->id)
                                            ->take(3)
                                            ->get(),
            'iznajmljivanjeArhivirane' => $reservationService->getArhiviraneRezervacije()
                                            ->where('book_id', '=', $knjiga->id)
                                            ->paginate(7),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Sacuvaj novu knjigu
     *
     * @param  Request $request
     * @param  BookService $bookService
     * @return void
     */
    public function sacuvajKnjigu(Request $request, BookService $bookService, DashboardService $dashboardService) {
        $viewName = $this->viewFolder . '.knjigaOsnovniDetalji';

        //request all data, validate and update author
        request()->validate([
            'nazivKnjiga'      => 'required|max:256',
            'kratki_sadrzaj'   => 'max:4128',
            'valuesKategorije' => 'required',
            'valuesZanrovi'    => 'required',
            'valuesAutori'     => 'required',
            'knjigaIzdavac'    => 'required',
            'godinaIzdavanja'  => 'required',
            'knjigaKolicina'   => 'required',
            'brStrana'         => 'required',
            'knjigaPismo'      => 'required',
            'knjigaPovez'      => 'required',
            'knjigaFormat'     => 'required',
            'knjigaIsbn'       => 'required|unique:books,ISBN|regex:/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/',
            'knjigaJezik'      => 'required',
            'movieImages'      => 'required',
            'movieImages.*'    => 'mimes:jpeg,png,jpg',
            'imageCover'       => 'required'
        ]);

        $knjiga = $bookService->saveBook();
        $bookService->uploadBookImages($knjiga->id, $request);

        $kategorijeValues = $request->input('valuesKategorije');
        $bookService->saveBookCategories($kategorijeValues, $knjiga->id);

        $zanroviValues = $request->input('valuesZanrovi');
        $bookService->saveBookGenres($zanroviValues, $knjiga->id);

        $autoriValues = $request->input('valuesAutori');
        $bookService->saveBookAuthors($autoriValues, $knjiga->id);

        $viewModel = [
            'knjiga'     => $knjiga,
            'aktivnosti' => $dashboardService->getBookActivity($knjiga->id)
                                ->take(3)
                                ->get(),
        ];

        //redirect to book
        // return view($viewName, $viewModel);
        return redirect('evidencijaKnjiga')->with('success', 'Knjiga je uspješno unsesena!');
    }

    /**
     * Updateuj knjigu
     *
     * @param  Request $request
     * @param  BookService $bookService
     * @return void
     */
    public function updateKnjiga(Request $request, Book $knjiga, DashboardService $dashboardService, Galery $gallery) {
        $viewName = $this->viewFolder . '.knjigaOsnovniDetalji';

        //request all data, validate and update author
        request()->validate([
            'nazivKnjigaEdit'       => 'required|max:256',
            'kratki_sadrzaj_edit'   => 'required|max:4128',
            'kategorijaValuesEdit'  => 'required',
            'zanrValuesEdit'        => 'required',
            'autoriValuesEdit'      => 'required',
            'izdavacEdit'           => 'required',
            'godinaIzdavanjaEdit'   => 'required',
            'knjigaKolicinaEdit'    => 'required',
            'brStranaEdit'          => 'required',
            'pismoEdit'             => 'required',
            'povezEdit'             => 'required',
            'formatEdit'            => 'required',
            'isbnEdit'              => 'nullable|unique:books,ISBN|max:20',
            'jezikEdit'             => 'required',
        ]);

        $knjiga->title=request('nazivKnjigaEdit');
        $knjiga->pages=request('brStranaEdit');
        $knjiga->publishYear=request('godinaIzdavanjaEdit');
        $knjiga->quantity=request('knjigaKolicinaEdit');
        $knjiga->summary=request('kratki_sadrzaj_edit');
        $knjiga->format_id=request('formatEdit');
        $knjiga->binding_id=request('povezEdit');
        $knjiga->script_id=request('pismoEdit');
        $knjiga->publisher_id=request('izdavacEdit');
        $knjiga->language_id=request('jezikEdit');

        if(request('isbnEdit')) {
            $knjiga->ISBN = request('isbnEdit');
        }

        $knjiga->save();

        if($request->movieImage){
            $filenameWithExt = $request->movieImage->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->movieImage->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            // Upload Image
            $path = $request->movieImage->storeAs('public/image', $fileNameToStore);
        
            $galery = new Galery();

            $gallery->book_id = $knjiga->id;
            $gallery->photo = $fileNameToStore;

            $gallery->save();
        }

        $kategorijeValues = $request->input('kategorijaValuesEdit');
        $kategorije = explode(',', $kategorijeValues);

        foreach($kategorije as $kategorija) {
            $knjigaKategorije = BookCategory::find($kategorija);
            $knjigaKategorije->book_id = $knjiga->id;
            $knjigaKategorije->category_id = $kategorija;
            $knjigaKategorije->save();
        }

        $zanroviValues = $request->input('zanrValuesEdit');
        $zanrovi = explode(',', $zanroviValues);

        foreach($zanrovi as $zanr) {
            $knjigaZanrovi = BookGenre::find($zanr);
            $knjigaZanrovi->book_id = $knjiga->id;
            $knjigaZanrovi->genre_id = $zanr;
            $knjigaZanrovi->save();
        }

        $autoriValues = $request->input('autoriValuesEdit');
        $autori = explode(',', $autoriValues);

        foreach($autori as $autor) {
            $knjigaAutori = BookAuthor::find($autor);
            $knjigaAutori->book_id = $knjiga->id;
            $knjigaAutori->author_id = $autor;
            $knjigaAutori->save();
        }

        $viewModel = [
            'knjiga'     => $knjiga,
            'aktivnosti' => $dashboardService->getBookActivity($knjiga->id)
                                ->take(3)
                                ->get(),
        ];

        return redirect('evidencijaKnjiga')->with('success', 'Knjiga je uspješno izmijenjena.');
    }

    /**
     * Izbrisi konkretnu knjigu
     *
     * @param  Book $knjiga
     * @return void
     */
    public function izbrisiKnjigu(Book $knjiga) {
        Book::destroy($knjiga->id);
        return redirect('evidencijaKnjiga')->with('success','Knjiga je uspješno obrisana!');
    }

    /**
     * Filter autora u tabeli
     *
     * @param  BookService $bookService
     * @param  AuthorService $autorService
     * @param  CategoryService $kategorijaService
     * @return void
     */
    public function filterAutori(BookService $bookService, AuthorService $autorService, CategoryService $kategorijaService) {
        $viewName = $this->viewFolder . '.evidencijaKnjiga';

        $knjige = $bookService->filterAutori()
                        ->paginate(7)
                        ->appends([
                            'autoriFilter' => request('autoriFilter'),
                            'kategorijeFilter' => request('kategorijeFilter')
                        ]);

        $viewModel = [
            'knjige'     => $knjige,
            'autori'     => $autorService->getAutori()->get(),
            'kategorije' => $kategorijaService->getCategories()->get(),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Vrati knjige
     *
     * @param  BookService $bookService
     * @param  GlobalVariableService $globalVariableService
     * @return void
     */
    public function returnBooks(BookService $bookService, GlobalVariableService $globalVariableService) {

        $bookService->returnBooks($globalVariableService);

        return back()->with('success', 'Knjiga je uspješno vraćena!');
    }

    /**
     * Otpisi knjige
     *
     * @param  BookService $bookService
     * @return void
     */
    public function writeOffBooks(BookService $bookService){

        $bookService->writeOffBooks();

        return back()->with('success', 'Knjiga je uspješno otpisana!');
    }

    /**
     * Prikazi pretrazene knjige
     *
     * @param  BookService $bookService
     * @return void
     */
    public function searchKnjige(BookService $bookService, Authorservice $authorService) {

        $viewName = $this->viewFolder . '.evidencijaKnjiga';

        $knjige = $bookService->searchKnjige();

        $viewModel = [
            'knjige'     => $knjige,
            'autori'     => $authorService->getAutori()->get(),
            'kategorije' => Category::all()
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi pretrazene ucenike cije se knjige vracaju
     *
     * @param  Book $book
     * @param  BookService $bookService
     * @param  RentService $rentService
     * @return void
     */
    public function searchReturn(Book $book, BookService $bookService, RentService $rentService) {

        $viewName = $this->viewFolder . '.returnBook';

        $rentedBooks = $bookService->searchReturnBook($book, $rentService);

        $viewModel = [
            'rentedBooks'     => $rentedBooks,
            'book'           => $book
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi pretrazene ucenike cije se knjige otpisuju
     *
     * @param  Book $book
     * @param  BookService $bookService
     * @param  RentService $rentService
     * @return void
     */
    public function searchWriteOff(Book $book, BookService $bookService, RentService $rentService) {

        $viewName = $this->viewFolder . '.writeOffBook';

        $overdueBooks = $bookService->searchWriteOffBooks($book, $rentService);

        $viewModel = [
            'overdueBooks'     => $overdueBooks,
            'book'     => $book
        ];

        return view($viewName, $viewModel);
    }

}
