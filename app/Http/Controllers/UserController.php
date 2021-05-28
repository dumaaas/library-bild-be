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

    public function prikaziBibliotekare(UserService $userService) {

        $viewName = $this->viewFolderLibrarian . '.bibliotekari';

        $viewModel = [
            'bibliotekari' => $userService->getBibliotekari()->paginate(7)
        ];

        return view($viewName, $viewModel);
    }

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

    public function prikaziNoviBibliotekar() {

        $viewName = $this->viewFolderLibrarian . '.noviBibliotekar';

        return view($viewName);
    }

    public function izmijeniBibliotekara(User $user, UserService $userService) {

        $viewName = $this->viewFolderLibrarian . '.bibliotekarProfile';

        $viewModel = [
            'user' => $user
        ];

        $userService->editBibliotekar($user);

        //return back to the edit author form
        return view($viewName, $viewModel);
    }

    public function izbrisiBibliotekara(User $user) {

        $viewName = $this->viewFolderLibrarian . '.bibliotekari';

        $viewModel = [
            'bibliotekari' => User::with('userType')
                    ->where('userType_id', '=', 2)
                    ->paginate(7)
        ];

        if ($user->userType->name != 'student' && (Gate::allows('isMyAccount', $user) || Gate::allows('isAdmin'))) {
            User::destroy($user->id);
            return view($viewName, $viewModel);
        } else {
            return abort(403, trans('Sorry, not sorry!'));
        }
    }

    public function resetujSifru(User $user, UserService $userService) {

        if($user->userType->id == 2) {
            $viewName = $this->viewFolderLibrarian . '.bibliotekarProfile';
        } else {
            $viewName = $this->viewFolderStudent . '.ucenikProfile';
        }

        $viewModel = [
            'user' => $user
        ];

        $userService->resetujSifru($user);

        return view($viewName, $viewModel);
    }

    public function sacuvajBibliotekara(UserService $userService) {

        $viewName = $this->viewFolderLibrarian . '.bibliotekarProfile';

        $user = $userService->saveBibliotekar();

        $viewModel = [
            'user' => $user
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

    public function prikaziNovogUcenika() {

        $viewName = $this->viewFolderStudent . '.noviUcenik';

        return view($viewName);
    }

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
    public function izmjeniUcenika(User $user, UserService $userService) {

        $viewName = $this->viewFolderStudent . '.ucenikProfile';

        $viewModel = [
            'user' => $user
        ];

        $userService->editUcenik($user);

        //return back to the edit student form
        return view($viewName, $viewModel);
    }

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
            return view($viewName, $viewModel);
        }
    }

    public function sacuvajUcenika(UserService $userService) {

        $viewName = $this->viewFolderStudent . '.ucenikProfile';

        $user = $userService->saveUcenik();

        $viewModel = [
            'user' => $user
        ];

        //return back to the edit student form
        return view($viewName, $viewModel);
    }

    public function prikaziUcenikIzdate(User $user) {

        $viewName = $this->viewFolderStudent . '.ucenikIzdate';

        $viewModel = [
            'user' => $user,
            'ucenikIzdate'=> Rent::with('book', 'student', 'librarian')
                ->where('return_date', '=', null)
                ->where('student_id', '=', $user->id)
                ->paginate(7),
        ];

        return view($viewName, $viewModel);
    }

    public function prikaziUcenikVracene(User $user) {

        $viewName = $this->viewFolderStudent . '.ucenikVracene';

        $viewModel = [
            'user' => $user,
            'ucenikVracene' => Rent::with('book', 'student', 'librarian')
                ->where('return_date', '!=', null)
                ->where('student_id', '=', $user->id)
                ->paginate(7),
        ];

        return view($viewName, $viewModel);
    }

    public function prikaziUcenikPrekoracenje(User $user) {

        $viewName = $this->viewFolderStudent . '.ucenikPrekoracenje';

        $viewModel = [
            'user' => $user,
            'ucenikPrekoracene' => Rent::with('book', 'student', 'librarian')
                ->where('return_date', '=', null)->where('rent_date', '<', Carbon::now()->subDays(30))
                ->where('student_id', '=', $user->id)
                ->paginate(7),
        ];

        return view($viewName, $viewModel);
    }

    public function prikaziUcenikAktivne(User $user) {

        $viewName = $this->viewFolderStudent . '.ucenikAktivne';

        $viewModel = [
            'user' => $user,
            'ucenikAktivne' => Reservation::with('book', 'student')
                ->where('close_date', '=', null)
                ->where('student_id', '=', $user->id)
                ->paginate(7),
        ];

        return view($viewName, $viewModel);
    }

    public function prikaziUcenikArhivirane(User $user) {

        $viewName = $this->viewFolderStudent . '.ucenikArhivirane';

        $viewModel = [
            'user' => $user,
            'ucenikArhivirane' => Reservation::with('book', 'student', 'reservationStatus')
                ->where('close_date', '!=', null)
                ->where('student_id', '=', $user->id)
                ->paginate(7),
        ];

        return view($viewName, $viewModel);
    }
}
