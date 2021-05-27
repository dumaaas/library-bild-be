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

    public function prikaziBibliotekare(UserService $userService) {

        $viewName = $this->viewFolderLibrarian . '.bibliotekari';

        $viewModel = [
            'bibliotekari' => $userService->getBibliotekari()->paginate(7)
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

    public function izmijeniBibliotekara(User $bibliotekar, UserService $userService) {

        $viewName = $this->viewFolderLibrarian . '.bibliotekarProfile';

        $viewModel = [
            'bibliotekar' => $bibliotekar
        ];

        $userService->editBibliotekar($bibliotekar);

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

    public function sacuvajBibliotekara(UserService $userService) {

        $viewName = $this->viewFolderLibrarian . '.bibliotekarProfile';

        $bibliotekar = $userService->saveBibliotekar();

        $viewModel = [
            'bibliotekar' => $bibliotekar
        ];

        //return back to the librarian profile
        return view($viewName, $viewModel);
    }

    public function prikaziUcenike(UserService $userService) {

        $viewName = $this->viewFolderStudent . '.ucenik';

        $viewModel = [
            'ucenici' => $userService->getUcenici()->paginate(7)
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
    public function izmjeniUcenika(User $ucenik, UserService $userService) {

        $viewName = $this->viewFolderStudent . '.ucenikProfile';

        $viewModel = [
            'ucenik' => $ucenik
        ];

        $userService->editUcenik($ucenik);

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

    public function sacuvajUcenika(UserService $userService) {

        $viewName = $this->viewFolderStudent . '.ucenikProfile';

        $ucenik = $userService->saveUcenik();

        $viewModel = [
            'ucenik' => $ucenik
        ];

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
