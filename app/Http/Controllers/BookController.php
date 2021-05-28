<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Book;
use App\Models\Author;
use App\Models\BookAuthor;
use App\Models\Category;
use App\Models\BookCategory;
use App\Models\BookGenre;
use App\Models\Rent;
use App\Models\RentStatus;
use App\Models\Reservation;
use App\Models\ReservationStatus;
use App\Models\GlobalVariable;
use App\Services\AuthorService;
use App\Services\BookService;
use App\Services\DashboardService;
use App\Services\RentService;
use App\Services\UserService;
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
    private $viewFolder = 'pages/knjiga';

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
            'aktivnosti' => $dashboardService->getBookActivity($knjiga->id),
        ];
        
        return view($viewName, $viewModel);
    }

    /**
     * Prikazi stranicu sa osnovnim detaljima konkretne knjige
     *
     * @param  Book $knjiga
     * @param  DashboardService $dashboardService
     * @return void
     */
    public function prikaziKnjigaOsnovniDetalji(Book $knjiga, DashboardService $dashboardService) {
        $viewName = $this->viewFolder . '.knjigaOsnovniDetalji';

        $viewModel = [
            'knjiga'     => $knjiga,
            'aktivnosti' => $dashboardService->getBookActivity($knjiga->id)
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
    public function prikaziKnjigaSpecifikacija(Book $knjiga, DashboardService $dashboardService) {
        $viewName = $this->viewFolder . '.knjigaSpecifikacija';

        $viewModel = [
            'knjiga'     => $knjiga,
            'aktivnosti' => $dashboardService->getBookActivity($knjiga->id),
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
     * @param  Book $knjiga
     * @param  DashboardService $dashboardService
     * @return void
     */
    public function prikaziVratiKnjigu(Book $knjiga, RentService $rentService) {
        $viewName = $this->viewFolder . '.vratiKnjigu';

        $vratiKnjige = $rentService->getIzdateKnjige()
                            ->where('book_id', '=', $knjiga->id)
                            ->paginate(7);
        
        $viewModel = [
            'knjiga'      => $knjiga,
            'vratiKnjige' => $vratiKnjige,
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi stranicu za otpis knjige
     *
     * @param  Book $knjiga
     * @param  DashboardService $dashboardService
     * @return void
     */
    public function prikaziOtpisiKnjigu(Book $knjiga, RentService $rentService) {
        $viewName = $this->viewFolder . '.otpisiKnjigu';

        $otpisiKnjige = $rentService->getPrekoraceneKnjige()
                            ->where('book_id', '=', $knjiga->id)
                            ->paginate(7);

        $viewModel = [
            'knjiga'       => $knjiga,
            'otpisiKnjige' => $otpisiKnjige  
        ];
        
        return view($viewName, $viewModel);
    }

    /**
     * Prikazi stranicu za vracanje knjige
     *
     * @param  Book $knjiga
     * @param  UserService $userService
     * @param  RentService $rentService
     * @return void
     */
    public function prikaziRezervisiKnjigu(Book $knjiga, UserService $userService, RentService $rentService) {
        $viewNameRezervisi = $this->viewFolder . '.rezervisiKnjigu';
        $viewNameError = $this->viewFolder . '.izdajKnjiguError';

        $knjigeNaRaspolaganju = $knjiga->quantity - $knjiga->rentedBooks - $knjiga->reservedBooks;

        $viewModelRezervisi = [
            'knjiga'  => $knjiga,
            'ucenici' => $userService->getUcenici()->get(),
        ];

        $viewModelError = [
            'knjiga'            => $knjiga,
            'prekoraceneKnjige' => $rentService->getPrekoraceneKnjige()
                                        ->where('book_id', '=', $knjiga->id)
                                        ->get()
        ];

        if($knjigeNaRaspolaganju > 0) {
            return view($viewNameRezervisi, $viewModelRezervisi);
        } else {
            return view($viewNameError, $viewModelError);
        }
    }

    /**
     * Prikazi stranicu za vracanje knjige
     *
     * @param  Book $knjiga
     * @param  UserService $userService
     * @param  RentService $rentService
     * @return void
     */
    public function prikaziIzdajKnjigu(Book $knjiga, UserService $userService, RentService $rentService) {
        $viewNameIzdaj = $this->viewFolder . '.izdajKnjigu';
        $viewNameError = $this->viewFolder . '.izdajKnjiguError';

        $knjigeNaRaspolaganju = $knjiga->quantity - $knjiga->rentedBooks - $knjiga->reservedBooks;

        $viewModelIzdaj = [
            'knjiga'            => $knjiga,
            'ucenici'           => $userService->getUcenici()->get(),
            'rokPozajmljivanja' => GlobalVariable::find(1),
            'prekoraceneKnjige' => $rentService->getPrekoraceneKnjige()
                                        ->where('book_id', '=', $knjiga->id)
                                        ->get(),
        ];

        $viewModelError = [
            'knjiga'            => $knjiga,
            'prekoraceneKnjige' => $rentService->getPrekoraceneKnjige()
                                        ->where('book_id', '=', $knjiga->id)
                                        ->get(),
        ];

        if($knjigeNaRaspolaganju > 0) {
            return view($viewNameIzdaj, $viewModelIzdaj);
        } else {
            return view($viewNameError, $viewModelError);
        }
    }

    /**
     * Izdaj knjigu 
     *
     * @param  Book $knjiga
     * @param  BookService $bookService
     * @param  RentService $rentService
     * @param  ReservationService $reservationService
     * @return void
     */
    public function sacuvajIzdavanje(Book $knjiga, BookService $bookService, RentService $rentService, ReservationService $reservationService) {

        $bookService->saveRent($knjiga->id, $rentService, $reservationService);

        return redirect('izdateKnjige');
    }

    /**
     * Rezervisi knjigu 
     *
     * @param  Book $knjiga
     * @param  BookService $bookService
     * @param  RentService $rentService
     * @param  ReservationService $reservationService
     * @return void
     */
    public function sacuvajRezervisanje(Book $knjiga, BookService $bookService, ReservationService $reservationService) {

        $bookService->saveReservation($knjiga, $reservationService);

        return redirect('aktivneRezervacije');
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
    public function prikaziIznajmljivanjeVracene(Book $knjiga, DashboardService $dashboardService, RentService $rentService) {
        $viewName = $this->viewFolder . '.iznajmljivanjeVracene';

        $viewModel = [
            'knjiga'                => $knjiga,
            'aktivnosti'            => $dashboardService->getBookActivity($knjiga->id)
                                            ->take(3)
                                            ->get(),
            'iznajmljivanjeVracene' => $rentService->getVraceneKnjige()
                                            ->where('book_id', '=', $knjiga->id)
                                            ->paginate(7),                              
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
            'iznajmljivanjeAktivne' => $reservationService->getRezervisaneKnjige()
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
    public function sacuvajKnjigu(Request $request, BookService $bookService) {
        $viewName = $this->viewFolder . '.novaKnjiga';

        //request all data, validate and update author
        request()->validate([
            'nazivKnjiga'     =>'required',
            'kratki_sadrzaj'  =>'required',
            'knjigaKategorije'=>'required',
            'knjigaZanrovi'   =>'required',
            'knjigaAutori'    =>'required',
            'knjigaIzdavac'   =>'required',
            'godinaIzdavanja' =>'required',
            'knjigaKolicina'  =>'required',
            'brStrana'        =>'required',
            'knjigaPismo'     =>'required',
            'knjigaPovez'     =>'required',
            'knjigaFormat'    =>'required',
            'knjigaIsbn'      =>'required',
            'knjigaJezik'     =>'required',
        ]);

        $knjiga = $bookService->saveBook();

        $kategorijeValues = $request->input('valuesKategorije');
        $kategorije = explode(',', $kategorijeValues);

        foreach($kategorije as $kategorija) {
            $bookService->saveBookCategories($knjiga->id, $kategorija);
        }

        $zanroviValues = $request->input('valuesZanrovi');
        $zanrovi = explode(',', $zanroviValues);

        foreach($zanrovi as $zanr) {
            $bookService->saveBookGenres($knjiga->id, $zanr);
        }

        $autoriValues = $request->input('valuesAutori');
        $autori = explode(',', $autoriValues);

        foreach($autori as $autor) {
            $bookService->saveBookAuthors($knjiga->id, $autor);
        }

        $viewModel = [
            'kategorije' => DB::table('categories')->get(),
            'zanrovi'    => DB::table('genres')->get(),
            'autori'     => DB::table('authors')->get(),
            'izdavaci'   => DB::table('publishers')->get(),
            'pisma'      => DB::table('scripts')->get(),
            'povezi'     => DB::table('bindings')->get(),
            'formati'    => DB::table('formats')->get(),
            'jezici'     => DB::table('languages')->get(),
        ];
        
        //return back to the edit author form
        return view($viewName, $viewModel);
    }

    /**
     * Updateuj knjigu
     *
     * @param  Request $request
     * @param  BookService $bookService
     * @return void
     */
    public function updateKnjiga(Request $request, Book $knjiga) {
        $viewName = $this->viewFolder . '.knjigaOsnovniDetalji';

        //request all data, validate and update author
        request()->validate([

        ]);

        $knjiga->title=request('nazivKnjigaEdit');
        $knjiga->pages=request('brStranaEdit');
        $knjiga->publishYear=request('godinaIzdavanjaEdit');
        $knjiga->ISBN=request('isbnEdit');
        $knjiga->quantity=request('knjigaKolicinaEdit');
        $knjiga->summary=request('kratki_sadrzaj_edit');
        $knjiga->format_id=request('formatEdit');
        $knjiga->binding_id=request('povezEdit');
        $knjiga->script_id=request('pismoEdit');
        $knjiga->publisher_id=request('izdavacEdit');
        $knjiga->language_id=request('jezikEdit');

        $knjiga->save();

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
            'knjiga' => $knjiga
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Izbrisi konkretnu knjigu
     *
     * @param  Book $knjiga
     * @return void
     */
    public function izbrisiKnjigu(Book $knjiga) {
        Book::destroy($knjiga->id);
        return back();
    }

    public function filterAutori(Request $request) {
        $viewName = $this->viewFolder . '.evidencijaKnjiga';

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

        $viewModel = [
            'knjige'     => $knjige->paginate(7),
            'autori'     => Author::all(),
            'kategorije' => Category::all(),
        ];

        return view($viewName, $viewModel);
    }

    public function vratiKnjige(Request $request){
        $viewName = $this->viewFolder . '.izdateKnjige';

        $knjige=request('vratiKnjigu');
        
        foreach($knjige as $knjiga){
            $rent=Rent::find($knjiga);
            // dd($rent);

            $rentStatus=new RentStatus();
            $rentStatus->rent_id=$rent->id;

            if($rent->rent_date<Carbon::now()->subDays(30)){
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

        $izdate = Rent::where(function ($query) {
            $query->select('statusBook_id')
                ->from('rent_statuses')
                ->whereColumn('rent_statuses.rent_id', 'rents.id')
                ->orderByDesc('rent_statuses.date')
                ->limit(1);
        }, 2);

        $viewModel = [
            'izdate'       => $izdate->paginate(7),
            'ucenici'      => DB::table('users')->where('userType_id', '=', 3)->get(),
            'bibliotekari' => DB::table('users')->where('userType_id', '=', 2)->get(),
        ];

        return view($viewName, $viewModel);
    }
        
    public function otpisiKnjige(){
        $viewName = $this->viewFolder . '.knjigePrekoracenje';

        $knjige=request('otpisiKnjigu');
        foreach($knjige as $knjiga){
            $rent=Rent::find($knjiga);
            $book=Book::find($rent->book_id);
            $book->rentedBooks=$book->rentedBooks-1;
            $book->quantity=$book->quantity-1;
            $book->save();
            Rent::destroy($rent->id);
        }

        $viewModel = [
            'prekoracene'  => Rent::with('book', 'student', 'librarian')
                                ->where('return_date', '=', null)
                                ->where('rent_date', '<', Carbon::now()->subDays(30))
                                ->paginate(7),
            'ucenici'      => DB::table('users')->where('userType_id', '=', 3)->get(),
            'bibliotekari' => DB::table('users')->where('userType_id', '=', 2)->get(),  
        ];
        
        return view($viewName, $viewModel);
    }

}
