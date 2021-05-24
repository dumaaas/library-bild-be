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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function prikaziEditKnjiga(Book $knjiga) {
        return view('editKnjiga', [
            'knjiga' => $knjiga,
            'kategorije' => DB::table('categories')->get(),
            'zanrovi' => DB::table('genres')->get(),
            'autori' => DB::table('authors')->get(),
            'izdavaci' => DB::table('publishers')->get(),
            'pisma' => DB::table('scripts')->get(),
            'povezi' => DB::table('bindings')->get(),
            'formati' => DB::table('formats')->get(),
            'jezici' => DB::table('languages')->get(),
        ]);
    }

    public function prikaziEditKnjigaMultimedija() {
        return view('editKnjigaMultimedija');
    }

    public function prikaziEditKnjigaSpecifikacija() {
        return view('editKnjigaSpecifikacija');
    }

    public function prikaziEvidencijaKnjiga() {
        return view('evidencijaKnjiga', [
            'knjige' => Book::paginate(7),
            'autori' => Author::all(),
            'kategorije' => Category::all(),
        ]);
    }

    public function prikaziEvidencijaKnjigaMultimedija(Book $knjiga) {
        return view('evidencijaKnjigaMultimedija', [
            'knjiga' => $knjiga,
            'aktivnosti' => Rent::with('book', 'student', 'librarian')->where('book_id', 'LIKE', $knjiga->id)->orderBy('rent_date', 'DESC')->take(3)->get(),
        ]);
    }

    public function prikaziKnjigaOsnovniDetalji(Book $knjiga) {
        return view('knjigaOsnovniDetalji', [
            'knjiga' => $knjiga,
            'aktivnosti' => Rent::with('book', 'student', 'librarian')->where('book_id', 'LIKE', $knjiga->id)->orderBy('rent_date', 'DESC')->take(3)->get(),
        ]);
    }

    public function prikaziKnjigaSpecifikacija(Book $knjiga) {
        return view('knjigaSpecifikacija', [
            'knjiga' => $knjiga,
            'aktivnosti' => Rent::with('book', 'student', 'librarian')->where('book_id', 'LIKE', $knjiga->id)->orderBy('rent_date', 'DESC')->take(3)->get(),
        ]);
    }

    public function prikaziNovaKnjiga() {
        return view('novaKnjiga', [
            'kategorije' => DB::table('categories')->get(),
            'zanrovi' => DB::table('genres')->get(),
            'autori' => DB::table('authors')->get(),
            'izdavaci' => DB::table('publishers')->get(),
            'pisma' => DB::table('scripts')->get(),
            'povezi' => DB::table('bindings')->get(),
            'formati' => DB::table('formats')->get(),
            'jezici' => DB::table('languages')->get(),
        ]);
    }

    public function prikaziNovaKnjigaMultimedija() {
        return view('novaKnjigaMultimedija');
    }

    public function prikaziNovaKnjigaSpecifikacija() {
        return view('novaKnjigaSpecifikacija');
    }

    public function prikaziVratiKnjigu(Book $knjiga) {
        return view('vratiKnjigu',[
            'knjiga' => $knjiga,
            'vratiKnjige' => Rent::with('book', 'student', 'librarian')->where('return_date', '=', null)->where('book_id', '=', $knjiga->id)->paginate(7),
            ]);
    }

    public function prikaziOtpisiKnjigu(Book $knjiga) {
        return view('otpisiKnjigu',[
            'knjiga' => $knjiga,
            'otpisiKnjige' => Rent::with('book', 'student', 'librarian')->where('return_date', '=', null)->where('rent_date', '<', Carbon::now()->subDays(30))->where('book_id', '=', $knjiga->id)->paginate(7),
            ]);
    }

    public function prikaziRezervisiKnjigu(Book $knjiga) {

        $knjigeNaRaspolaganju = $knjiga->quantity - $knjiga->rentedBooks - $knjiga->reservedBooks;

        if($knjigeNaRaspolaganju > 0) {
            return view('rezervisiKnjigu', [
                'knjiga' => $knjiga,
                'ucenici' => DB::table('users')->where('userType_id', '=', 3)->get(),
            ]);
        } else {
            return view('izdajKnjiguError', [
                'knjiga' => $knjiga,
                'prekoraceneKnjige' => Rent::with('book', 'student', 'librarian')->where('return_date', '=', null)->where('rent_date', '<', Carbon::now()->subDays(30))->where('book_id', '=', $knjiga->id)->get()
            ]);
        }
    }

    public function prikaziIzdajKnjigu(Book $knjiga) {

        $knjigeNaRaspolaganju = $knjiga->quantity - $knjiga->rentedBooks - $knjiga->reservedBooks;

        if($knjigeNaRaspolaganju > 0) {
            return view('izdajKnjigu', [
                'knjiga' => $knjiga,
                'prekoraceneKnjige' => Rent::with('book', 'student', 'librarian')->where('return_date', '=', null)->where('rent_date', '<', Carbon::now()->subDays(30))->where('book_id', '=', $knjiga->id)->get(),
                'ucenici' => DB::table('users')->where('userType_id', '=', 3)->get(),
            ]);
        } else {
            return view('izdajKnjiguError', [
                'knjiga' => $knjiga,
                'prekoraceneKnjige' => Rent::with('book', 'student', 'librarian')->where('return_date', '=', null)->where('rent_date', '<', Carbon::now()->subDays(30))->where('book_id', '=', $knjiga->id)->get()
            ]);
        }
    }

    public function sacuvajIzdavanje(Request $request, Book $knjiga) {
        request()->validate([
            'ucenik'=>'required',
            'datumIzdavanja'=>'required',
        ]);

        $izdavanje = new Rent();

        $izdavanje->book_id = $knjiga->id;
        $izdavanje->librarian_id = Auth::id();
        $izdavanje->student_id = request('ucenik');
        $izdavanje->rent_date = request('datumIzdavanja');

        $izdavanje->save();

        //dodavanje u tabelu rent_statuses
        $statusIzdavanja = new RentStatus();
        $statusIzdavanja->rent_id = $izdavanje->id;
        $statusIzdavanja->statusBook_id = 2;
        $statusIzdavanja->date = $izdavanje->rent_date;
        $statusIzdavanja->save();

        //update broj izdatih knjiga
        $izdataKnjiga = Book::find($knjiga->id);
        $updateIzdateKnjige = $izdataKnjiga->rentedBooks + 1;
        $izdataKnjiga->rentedBooks = $updateIzdateKnjige;
        $izdataKnjiga->save();

        return redirect('izdateKnjige');
    }

    public function sacuvajRezervisanje(Request $request, Book $knjiga) {
        request()->validate([
            'ucenik'=>'required',
            'datumRezervisanja'=>'required',
        ]);

        $rezervisanje = new Reservation();

        $rezervisanje->book_id = $knjiga->id;
        $rezervisanje->librarian_id = Auth::id();
        $rezervisanje->student_id = request('ucenik');
        $rezervisanje->reservation_date = request('datumRezervisanja');
        $rezervisanje->request_date = now();

        $rezervisanje->save();

        //dodavanje u tabelu rent_statuses
        $statusRezervisanja = new ReservationStatus();
        $statusRezervisanja->reservation_id = $rezervisanje->id;
        $statusRezervisanja->statusReservation_id = 1;
        $statusRezervisanja->date = $rezervisanje->reservation_date;
        $statusRezervisanja->save();

        //update broj rezervisanih knjiga
        $rezervisanaKnjiga = Book::find($knjiga->id);
        $updateRezervisanaKnjige = $rezervisanaKnjiga->reservedBooks + 1;
        $rezervisanaKnjiga->reservedBooks = $updateRezervisanaKnjige;
        $rezervisanaKnjiga->save();

        return redirect('aktivneRezervacije');
    }

    public function prikaziIznajmljivanjeIzdate(Book $knjiga) {

        return view('iznajmljivanjeIzdate', [
            'knjiga' => $knjiga,
            'aktivnosti' => Rent::with('book', 'student', 'librarian')->where('book_id', 'LIKE', $knjiga->id)->orderBy('rent_date', 'DESC')->take(3)->get(),
            'iznajmljivanjeIzdate' => Rent::with('book', 'student', 'librarian')->where('return_date', '=', null)->where('book_id', '=', $knjiga->id)->paginate(7),
        ]);
    }

    public function prikaziIznajmljivanjePrekoracenje(Book $knjiga) {
        return view('iznajmljivanjePrekoracenje', [
            'knjiga' => $knjiga,
            'aktivnosti' => Rent::with('book', 'student', 'librarian')->where('book_id', 'LIKE', $knjiga->id)->orderBy('rent_date', 'DESC')->take(3)->get(),
            'iznajmljivanjePrekoracene' => Rent::with('book', 'student', 'librarian')->where('return_date', '=', null)->where('rent_date', '<', Carbon::now()->subDays(30))->where('book_id', '=', $knjiga->id)->paginate(7),
        ]);
    }

    public function prikaziIznajmljivanjeVracene(Book $knjiga) {
        return view('iznajmljivanjeVracene', [
            'knjiga' => $knjiga,
            'aktivnosti' => Rent::with('book', 'student', 'librarian')->where('book_id', 'LIKE', $knjiga->id)->orderBy('rent_date', 'DESC')->take(3)->get(),
            'iznajmljivanjeVracene' => Rent::with('book', 'student', 'librarian')->where('return_date', '!=', null)->where('book_id', '=', $knjiga->id)->paginate(7),
        ]);
    }

    public function prikaziIznajmljivanjeAktivne(Book $knjiga) {
        return view('iznajmljivanjeAktivne', [
            'knjiga' => $knjiga,
            'aktivnosti' => Rent::with('book', 'student', 'librarian')->where('book_id', 'LIKE', $knjiga->id)->orderBy('rent_date', 'DESC')->take(3)->get(),
            'iznajmljivanjeAktivne' => Reservation::with('book', 'student')->where('close_date', '=', null)->where('book_id', '=', $knjiga->id)->paginate(7),
        ]);
    }

    public function prikaziIznajmljivanjeArhivirane(Book $knjiga) {
        return view('iznajmljivanjeArhivirane', [
            'knjiga' => $knjiga,
            'aktivnosti' => Rent::with('book', 'student', 'librarian')->where('book_id', 'LIKE', $knjiga->id)->orderBy('rent_date', 'DESC')->take(3)->get(),
            'iznajmljivanjeArhivirane' => Reservation::with('book', 'student', 'reservationStatus')->where('close_date', '!=', null)->where('book_id', '=', $knjiga->id)->paginate(7),
        ]);
    }

    public function sacuvajKnjigu(Request $request) {
        //request all data, validate and update author
        request()->validate([
            'nazivKnjiga'=>'required',
            'kratki_sadrzaj'=>'required',
            'knjigaKategorije'=>'required',
            'knjigaZanrovi'=>'required',
            'knjigaAutori'=>'required',
            'knjigaIzdavac'=>'required',
            'godinaIzdavanja'=>'required',
            'knjigaKolicina'=>'required',
            'brStrana'=>'required',
            'knjigaPismo'=>'required',
            'knjigaPovez'=>'required',
            'knjigaFormat'=>'required',
            'knjigaIsbn'=>'required',
            'knjigaJezik' =>'required',
        ]);

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

        $kategorijeValues = $request->input('valuesKategorije');
        $kategorije = explode(',', $kategorijeValues);

        foreach($kategorije as $kategorija) {
            $knjigaKategorije = new BookCategory();
            $knjigaKategorije->book_id = $knjiga->id;
            $knjigaKategorije->category_id = $kategorija;
            $knjigaKategorije->save();
        }

        $zanroviValues = $request->input('valuesZanrovi');
        $zanrovi = explode(',', $zanroviValues);

        foreach($zanrovi as $zanr) {
            $knjigaZanrovi = new BookGenre();
            $knjigaZanrovi->book_id = $knjiga->id;
            $knjigaZanrovi->genre_id = $zanr;
            $knjigaZanrovi->save();
        }

        $autoriValues = $request->input('valuesAutori');
        $autori = explode(',', $autoriValues);

        foreach($autori as $autor) {
            $knjigaAutori = new BookAuthor();
            $knjigaAutori->book_id = $knjiga->id;
            $knjigaAutori->author_id = $autor;
            $knjigaAutori->save();
        }


        //return back to the edit author form
        return view('novaKnjiga', [
            'kategorije' => DB::table('categories')->get(),
            'zanrovi' => DB::table('genres')->get(),
            'autori' => DB::table('authors')->get(),
            'izdavaci' => DB::table('publishers')->get(),
            'pisma' => DB::table('scripts')->get(),
            'povezi' => DB::table('bindings')->get(),
            'formati' => DB::table('formats')->get(),
            'jezici' => DB::table('languages')->get(),
        ]);
    }

    public function updateKnjiga(Request $request, Book $knjiga) {
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

        //return back to the edit author form
        return view('knjigaOsnovniDetalji', [
            'knjiga' => $knjiga,
        ]);
    }

    public function izbrisiKnjigu(Book $knjiga) {
        Book::destroy($knjiga->id);
        return back();
    }

    public function filterAutori(Request $request) {
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

        $knjige = $knjige->paginate(7);


        return view('evidencijaKnjiga', [
            'knjige' => $knjige,
            'autori' => Author::all(),
            'kategorije' => Category::all(),
        ]);
    }

    public function vratiKnjige(Request $request){

        $knjige=request('vratiKnjigu');
        
        foreach($knjige as $knjiga){
            $rent=Rent::find($knjiga);
            // dd($rent);
            $rent->return_date=Carbon::now();
            $rent->save();

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
            // dd($book);
            $book->rentedBooks=$book->rentedBooks-1;
        }
        return view('izdateKnjige', [
            'izdate' => Rent::with('book', 'student', 'librarian')->where('return_date', '=', null)->paginate(7),
            'ucenici' => DB::table('users')->where('userType_id', '=', 3)->get(),
            'bibliotekari' => DB::table('users')->where('userType_id', '=', 2)->get(),
        ]);
    }


}
