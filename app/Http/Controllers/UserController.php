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
use App\Services\UserService;
use App\Services\RentService;
use App\Services\ReservationService;

/*
|--------------------------------------------------------------------------
| UserController
|--------------------------------------------------------------------------
|
| UserController je odgovaran za povezivanje logike
| izmedju bibliotekar/ucenik view-a i neophodnih Modela
|
*/

class UserController extends Controller
{

    private $viewFolderLibrarian = 'pages/bibliotekar';
    private $viewFolderStudent = 'pages/ucenik';

    /**
     * Prikazi konkretnog bibliotekara
     *
     * @param  User $user
     * @return void
     */
    public function prikaziBibliotekara(User $user) {

        $viewName = $this->viewFolderLibrarian . '.bibliotekarProfile';

        $viewModel = [
            'user' => $user
        ];

        if ($user->userType->name != 'student' && (Gate::allows('isMyAccount', $user) || Gate::allows('isAdmin'))) {
            return view($viewName, $viewModel);
        }
        return abort(403, trans('Sorry, not sorry!'));
    }

    /**
     * Prikazi sve bibliotekare
     *
     * @param  UserService $userService
     * @return void
     */
    public function prikaziBibliotekare(UserService $userService) {

        $viewName = $this->viewFolderLibrarian . '.bibliotekari';

        $viewModel = [
            'bibliotekari' => $userService->getBibliotekari()->paginate(7)
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi stranicu za editovanje bibliotekara
     *
     * @param  User $user
     * @return void
     */
    public function prikaziEditBibliotekar(User $user) {

        $viewName = $this->viewFolderLibrarian . '.editBibliotekar';

        $viewModel = [
            'user' => $user
        ];

        if ($user->userType->name != 'student' && (Gate::allows('isMyAccount', $user) || Gate::allows('isAdmin'))) {
            return view($viewName, $viewModel);
        }
        return abort(403, trans('Sorry, not sorry!'));
    }

    /**
     * Prikazi stranicu za unos novog bibliotekara
     *
     * @return void
     */
    public function prikaziNoviBibliotekar() {

        $viewName = $this->viewFolderLibrarian . '.noviBibliotekar';

        return view($viewName);
    }

    /**
     * Izmijeni podatke o bibliotekaru
     *
     * @param  User $user
     * @param  AuthorService $autorService
     * @return void
     */
    public function izmijeniBibliotekara(User $user, UserService $userService, Request $request) {

        $userService->editBibliotekar($user, $request);

        //return back to the edit author form
        return back()->with('success', 'Bibliotekar uspjesno izmjenjen!');
    }

    /**
     * Izbrisi bibliotekara
     *
     * @param  User $user
     * @return void
     */
    public function izbrisiBibliotekara(User $user) {

        $viewName = $this->viewFolderLibrarian . '.bibliotekari';

        $viewModel = [
            'bibliotekari' => User::with('userType')
                    ->where('userType_id', '=', 2)
                    ->paginate(7)
        ];

        if ($user->userType->name != 'student' && (Gate::allows('isMyAccount', $user) || Gate::allows('isAdmin'))) {
            User::destroy($user->id);
            return redirect('bibliotekari')->with('success', 'Bibliotekar uspjesno izbrisan!');
        } else {
            return abort(403, trans('Sorry, not sorry!'));
        }
    }

    /**
     * Resetuj sifru korisnika
     *
     * @param User  $user
     * @param UserService $userService
     * @return void
     */
    public function resetujSifru(User $user, UserService $userService) {

        $userService->resetujSifru($user);

        return back()->with('success', 'Sifra uspjesno resetovana!');
    }

    /**
     * Kreiraj i sacuvaj novog bibliotekara
     *
     * @param  AuthorService $autorService
     * @return void
     */
    public function sacuvajBibliotekara(UserService $userService, Request $request) {

        $viewName = $this->viewFolderLibrarian . '.bibliotekarProfile';

        $user = $userService->saveBibliotekar($request);

        $viewModel = [
            'user' => $user
        ];

        //return back to the librarian profile
        return back()->with('success', 'Bibliotekar uspjesno sacuvan!');
    }

    /**
     * Prikazi pretrazene bibliotekare
     *
     * @param  UserService $userService
     * @return void
     */
    public function searchBibliotekari(UserService $userService) {

        $viewName = $this->viewFolderLibrarian . '.bibliotekari';

        $bibliotekari = $userService->searchBibliotekari();

        $viewModel = [
            'bibliotekari' => $bibliotekari
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi sve ucenike
     *
     * @param  UserService $userService
     * @return void
     */
    public function prikaziUcenike(UserService $userService) {

        $viewName = $this->viewFolderStudent . '.ucenik';

        $viewModel = [
            'ucenici' => $userService->getUcenici()->paginate(7)
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi konkretnog ucenika
     *
     * @param  User $user
     * @return void
     */
    public function prikaziUcenikProfile(User $user) {

        $viewName = $this->viewFolderStudent . '.ucenikProfile';

        $viewModel = [
            'user' => $user
        ];

        if($user->userType->name != 'student') {
            return abort(403, trans('Sorry, not sorry!'));
        } else {
            return view($viewName, $viewModel);
        }
    }

    /**
     * Prikazi stranicu za unos novog ucenika
     *
     * @return void
     */
    public function prikaziNovogUcenika() {

        $viewName = $this->viewFolderStudent . '.noviUcenik';

        return view($viewName);
    }

    /**
     * Prikazi stranicu za editovanje ucenika
     *
     * @param  User $user
     * @return void
     */
    public function prikaziEditUcenik(User $user) {

        $viewName = $this->viewFolderStudent . '.editUcenik';

        $viewModel = [
            'user' => $user
        ];

        if($user->userType->name != 'student') {
            return abort(403, trans('Sorry, not sorry!'));
        } else {
            return view($viewName, $viewModel);
        }
    }

    /**
     * Izmijeni podatke o uceniku
     *
     * @param  User $user
     * @param  UserService $userService
     * @return void
     */
    public function izmjeniUcenika(User $user, UserService $userService, Request $request) {

        $viewName = $this->viewFolderStudent . '.ucenikProfile';

        $viewModel = [
            'user' => $user
        ];

        $userService->editUcenik($user, $request);

        //return back to the edit student form
        return back()->with('success', 'Ucenik uspjesno izmjenjen!');
    }

    /**
     * Izbrisi ucenika
     *
     * @param  User $user
     * @return void
     */
    public function izbrisiUcenika(User $user) {

        $viewName = $this->viewFolderStudent . '.ucenik';

        $viewModel = [
            'ucenici' => User::with('userType')
                    ->where('userType_id', '=', 3)
                    ->paginate(7)
        ];

        if($user->userType->name != 'student') {
            return abort(403, trans('Sorry, not sorry!'));
        } else {
            User::destroy($user->id);
            return redirect('ucenik')->with('success', 'Ucenik uspjesno izbrisan!');
        }
    }

    /**
     * Kreiraj i sacuvaj novog ucenika
     *
     * @param  AuthorService $autorService
     * @return void
     */
    public function sacuvajUcenika(UserService $userService, Request $request) {

        $viewName = $this->viewFolderStudent . '.ucenikProfile';

        $user = $userService->saveUcenik($request);

        $viewModel = [
            'user' => $user
        ];

        //return back to the edit student form
        return back()->with('success', 'Ucenik uspjesno sacuvan!');
    }

    /**
     * Prikazi pretrazene ucenike
     *
     * @param  UserService $userService
     * @return void
     */
    public function searchUcenici(UserService $userService) {

        $viewName = $this->viewFolderStudent . '.ucenik';

        $ucenici = $userService->searchUcenici();

        $viewModel = [
            'ucenici' => $ucenici
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi knjige izdate konkretnom uceniku
     *
     * @param  User $user
     * @param  RentService $rentService
     * @param  UserService $userService
     * @return void
     */
    public function prikaziUcenikIzdate(User $user, RentService $rentService, UserService $userService) {

        $viewName = $this->viewFolderStudent . '.ucenikIzdate';

        // pokupi samo knjige sa statusom izdata za konkretnog ucenika
        $izdate = $rentService->getIzdateKnjige()->where('student_id', '=', $user->id)->paginate(7);

        $viewModel = [
            'user' => $user,
            'ucenikIzdate'=> $izdate
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi knjige koje je konkretni ucenik vratio
     *
     * @param  User $user
     * @param  RentService $rentService
     * @param  UserService $userService
     * @return void
     */
    public function prikaziUcenikVracene(User $user, RentService $rentService, UserService $userService) {

        $viewName = $this->viewFolderStudent . '.ucenikVracene';

        $vracene = $rentService->getVraceneKnjige()->where('student_id', '=', $user->id)->paginate(7);

        $viewModel = [
            'user' => $user,
            'ucenikVracene' => $vracene
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi knjige izdate konkretnom uceniku koje su u prekoracenju
     *
     * @param  User $user
     * @param  RentService $rentService
     * @param  UserService $userService
     * @return void
     */
    public function prikaziUcenikPrekoracenje(User $user, RentService $rentService, UserService $userService) {

        $viewName = $this->viewFolderStudent . '.ucenikPrekoracenje';

        $prekoracene = $rentService->getPrekoraceneKnjige()->where('student_id', '=', $user->id)->paginate(7);

        $viewModel = [
            'user' => $user,
            'ucenikPrekoracene' => $prekoracene
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi aktivne rezervacije konkretnog ucenika
     *
     * @param  User $user
     * @param  ReservationService $reservationService
     * @return void
     */
    public function prikaziUcenikAktivne(User $user, ReservationService $reservationService) {

        $viewName = $this->viewFolderStudent . '.ucenikAktivne';

        $viewModel = [
            'user' => $user,
            'ucenikAktivne' => $reservationService->getAktivneRezervacije()->where('student_id', '=', $user->id)->paginate(7)
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi arhivirane rezervacije konkretnog ucenika
     *
     * @param  User $user
     * @param  ReservationService $reservationService
     * @return void
     */
    public function prikaziUcenikArhivirane(User $user, ReservationService $reservationService) {

        $viewName = $this->viewFolderStudent . '.ucenikArhivirane';

        $viewModel = [
            'user' => $user,
            'ucenikArhivirane' => $reservationService->getArhiviraneRezervacije()->where('student_id', '=', $user->id)->paginate(7)
        ];

        return view($viewName, $viewModel);
    }
}
