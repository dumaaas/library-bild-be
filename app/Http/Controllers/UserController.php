<?php

namespace App\Http\Controllers;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Rent;
use App\Models\Reservation;
use Carbon\Carbon;
use App\Models\Book;
use Illuminate\Support\Facades\Gate;
use Auth; 

class UserController extends Controller
{

    private $viewFolderLibrarian = 'pages/bibliotekar';
    private $viewFolderStudent = 'pages/ucenik';

    public function prikaziBibliotekara(User $bibliotekar) {

        $viewName = $this->viewFolderLibrarian . '.bibliotekarProfile';

        $viewModel = [
            'bibliotekar' => $bibliotekar
        ];

        if ($bibliotekar->userType->name != 'student' && (Gate::allows('isMyAccount', $bibliotekar) || Gate::allows('isAdmin'))) {
            return view($viewName, $viewModel);
        }
        return abort(403, trans('Sorry, not sorry!'));
    }

    public function prikaziBibliotekare() {

        $viewName = $this->viewFolderLibrarian . '.bibliotekari';

        $viewModel = [
            'bibliotekari' => User::with('userType')
                ->where('userType_id', '=', 2)
                ->paginate(7)
        ];

        return view($viewName, $viewModel);
    }

    public function prikaziEditBibliotekar(User $bibliotekar) {

        $viewName = $this->viewFolderLibrarian . '.editBibliotekar';

        $viewModel = [
            'bibliotekar' => $bibliotekar
        ];

        if ($bibliotekar->userType->name != 'student' && (Gate::allows('isMyAccount', $bibliotekar) || Gate::allows('isAdmin'))) {
            return view($viewName, $viewModel);
        } 
        return abort(403, trans('Sorry, not sorry!'));
    }

    public function prikaziNoviBibliotekar() {

        $viewName = $this->viewFolderLibrarian . '.noviBibliotekar';

        return view($viewName);
    }

    public function izmijeniBibliotekara(User $bibliotekar) {

        $viewName = $this->viewFolderLibrarian . '.bibliotekarProfile';

        $viewModel = [
            'bibliotekar' => $bibliotekar
        ];

        //request all data, validate and update librarian
        request()->validate([
            'imePrezimeBibliotekarEdit' => 'required',
            'jmbgBibliotekarEdit' => 'required',
            'emailBibliotekarEdit' => 'required',
            'usernameBibliotekarEdit' => 'required',
            'pwBibliotekarEdit' => 'required',
            'pw2BibliotekarEdit' => 'required',
        ]);

        $bibliotekar->name=request('imePrezimeBibliotekarEdit');
        $bibliotekar->jmbg=request('jmbgBibliotekarEdit');
        $bibliotekar->email=request('emailBibliotekarEdit');
        $bibliotekar->username=request('usernameBibliotekarEdit');

        $sifra1 = request('pwBibliotekarEdit');
        $sifra2 = request('pw2BibliotekarEdit');

        if($sifra1 == $sifra2){
            $bibliotekar->password=Hash::make($sifra1);  
        }else{
            //Promijeniti ovo
            echo('Moraju se poklapati sifre');
        }
             
        $bibliotekar->save();

        //return back to the edit author form
        return view($viewName, $viewModel);
    }

    public function izbrisiBibliotekara(User $bibliotekar) {

        $viewName = $this->viewFolderLibrarian . '.bibliotekari';

        $viewModel = [
            'bibliotekari' => User::with('userType')
                    ->where('userType_id', '=', 2)
                    ->paginate(7)
        ];

        if ($bibliotekar->userType->name != 'student' && (Gate::allows('isMyAccount', $bibliotekar) || Gate::allows('isAdmin'))) {
            User::destroy($bibliotekar->id);
            return view($viewName, $viewModel);
        } else {
            return abort(403, trans('Sorry, not sorry!'));
        }
    }

    public function sacuvajBibliotekara(User $bibliotekar) {

        $viewName = $this->viewFolderLibrarian . '.bibliotekarProfile';

        $viewModel = [
            'bibliotekar' => $bibliotekar
        ];

        //request all data, validate and add librarian
        request()->validate([
            'imePrezimeBibliotekar' => 'required',
            'jmbgBibliotekar' => 'required',
            'emailBibliotekar' => 'required',
            'usernameBibliotekar' => 'required',
            'pwBibliotekar' => 'required',
            'pw2Bibliotekar' => 'required',
        ]);

        $userTypeId = DB::table('user_types')->select('id')->where('name', '=', 'librarian')->value('id');
        $bibliotekar->userType_id = $userTypeId;

        $bibliotekar->name=request('imePrezimeBibliotekar');
        $bibliotekar->jmbg=request('jmbgBibliotekar');
        $bibliotekar->email_verified_at = now();
        $bibliotekar->email=request('emailBibliotekar');
        $bibliotekar->username=request('usernameBibliotekar');
        $bibliotekar->remember_token = Str::random(10);

        $sifra1 = request('pwBibliotekar');
        $sifra2 = request('pw2Bibliotekar');

        if($sifra1 == $sifra2){
            $bibliotekar->password=Hash::make($sifra1);  
        }else{
            //Promijeniti ovo
            echo('Moraju se poklapati sifre');
        }
             
        $bibliotekar->save();

        //return back to the librarian profile
        return view($viewName, $viewModel);
    }

    public function prikaziUcenike() {

        $viewName = $this->viewFolderStudent . '.ucenik';

        $viewModel = [
            'ucenici' => User::with('userType')->where('userType_id', '=', 3)->paginate(7)
        ];

        return view($viewName, $viewModel);
    }

    public function prikaziUcenikProfile(User $ucenik) {

        $viewName = $this->viewFolderStudent . '.ucenikProfile';

        $viewModel = [
            'ucenik' => $ucenik
        ];

        if($ucenik->userType->name != 'student') {
            return abort(403, trans('Sorry, not sorry!'));
        } else {
            return view($viewName, $viewModel);
        }
    }

    public function prikaziNovogUcenika() {

        $viewName = $this->viewFolderStudent . '.noviUcenik';

        return view($viewName);
    }

    public function prikaziEditUcenik(User $ucenik) {

        $viewName = $this->viewFolderStudent . '.editUcenik';

        $viewModel = [
            'ucenik' => $ucenik
        ];

        if($ucenik->userType->name != 'student') {
            return abort(403, trans('Sorry, not sorry!'));
        } else {
            return view($viewName, $viewModel);
        }
    }
    public function izmjeniUcenika(User $ucenik) {

        $viewName = $this->viewFolderStudent . '.ucenikProfile';

        $viewModel = [
            'ucenik' => $ucenik
        ];

         //request all data, validate and update student
         request()->validate([
            'imePrezimeUcenikEdit'=>'required',
            'jmbgUcenikEdit' => 'required',
            'emailUcenikEdit' => 'required',
            'usernameUcenikEdit' => 'required',
            'pwUcenikEdit' => 'required',
            'pw2UcenikEdit' => 'required',
        ]);
        $ucenik->name=request('imePrezimeUcenikEdit');
        $ucenik->jmbg=request('jmbgUcenikEdit');
        $ucenik->email=request('emailUcenikEdit');
        $ucenik->username=request('usernameUcenikEdit');
      
        $sifra1 = request('pwUcenikEdit');
        $sifra2 = request('pw2UcenikEdit');

        if($sifra1 == $sifra2){
            $ucenik->password=Hash::make($sifra1);  
        }else{
            //Promijeniti ovo
            echo('Moraju se poklapati sifre');
        }
             
        $ucenik->save();

        //return back to the edit student form
        return view($viewName, $viewModel);
    }

    public function izbrisiUcenika(User $ucenik) {

        $viewName = $this->viewFolderStudent . '.ucenik';

        $viewModel = [
            'ucenici' => User::with('userType')
                    ->where('userType_id', '=', 3)
                    ->paginate(7)
        ];

        if($ucenik->userType->name != 'student') {
            return abort(403, trans('Sorry, not sorry!'));
        } else {
            User::destroy($ucenik->id);
            return view($viewName, $viewModel);
        }
    }

    public function sacuvajUcenika(User $ucenik) {

        $viewName = $this->viewFolderStudent . '.ucenikProfile';

        $viewModel = [
            'ucenik' => $ucenik
        ];

        //request all data, validate and update student
        request()->validate([
            'imePrezimeUcenik'=>'required',
            'jmbgUcenik' => 'required',
            'emailUcenik' => 'required',
            'usernameUcenik' => 'required',
            'pwUcenik' => 'required',
            'pw2Ucenik' => 'required',
        ]);

        $userTypeId=DB::table('user_types')->select('id')->where('name', '=', 'student')->value('id');
        $ucenik->userType_id =$userTypeId;
    
        $ucenik->name=request('imePrezimeUcenik');
        $ucenik->jmbg=request('jmbgUcenik');
        $ucenik->email_verified_at = now();
        $ucenik->email=request('emailUcenik');
        $ucenik->username=request('usernameUcenik');
        $ucenik->remember_token = Str::random(10);

        $sifra1 = request('pwUcenik');
        $sifra2 = request('pw2Ucenik');

        if($sifra1 == $sifra2){
            $ucenik->password=Hash::make($sifra1);  
        }else{
            //Promijeniti ovo
            echo('Moraju se poklapati sifre');
        }

        $ucenik->save();

        //return back to the edit student form
        return view($viewName, $viewModel);
    }

    public function prikaziUcenikIzdate(User $ucenik) {

        $viewName = $this->viewFolderStudent . '.ucenikIzdate';

        $viewModel = [
            'ucenik' => $ucenik,
            'ucenikIzdate'=> Rent::with('book', 'student', 'librarian')
                ->where('return_date', '=', null)
                ->where('student_id', '=', $ucenik->id)
                ->paginate(7),
        ];

        return view($viewName, $viewModel);
    }

    public function prikaziUcenikVracene(User $ucenik) {

        $viewName = $this->viewFolderStudent . '.ucenikVracene';

        $viewModel = [
            'ucenik' => $ucenik,
            'ucenikVracene' => Rent::with('book', 'student', 'librarian')
                ->where('return_date', '!=', null)
                ->where('student_id', '=', $ucenik->id)
                ->paginate(7),
        ];

        return view($viewName, $viewModel);
    }

    public function prikaziUcenikPrekoracenje(User $ucenik) {

        $viewName = $this->viewFolderStudent . '.ucenikPrekoracenje';

        $viewModel = [
            'ucenik' => $ucenik,
            'ucenikPrekoracene' => Rent::with('book', 'student', 'librarian')
                ->where('return_date', '=', null)->where('rent_date', '<', Carbon::now()->subDays(30))
                ->where('student_id', '=', $ucenik->id)
                ->paginate(7),
        ];

        return view($viewName, $viewModel);
    }

    public function prikaziUcenikAktivne(User $ucenik) {

        $viewName = $this->viewFolderStudent . '.ucenikAktivne';

        $viewModel = [
            'ucenik' => $ucenik,
            'ucenikAktivne' => Reservation::with('book', 'student')
                ->where('close_date', '=', null)
                ->where('student_id', '=', $ucenik->id)
                ->paginate(7),
        ];

        return view($viewName, $viewModel);
    }

    public function prikaziUcenikArhivirane(User $ucenik) {

        $viewName = $this->viewFolderStudent . '.ucenikArhivirane';

        $viewModel = [
            'ucenik' => $ucenik,
            'ucenikArhivirane' => Reservation::with('book', 'student', 'reservationStatus')
                ->where('close_date', '!=', null)
                ->where('student_id', '=', $ucenik->id)
                ->paginate(7),
        ];

        return view($viewName, $viewModel);
    }
}
