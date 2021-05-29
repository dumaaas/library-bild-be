<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\RentStatus;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Book;
use App\Services\RentService;
use App\Services\UserService;
use App\Services\ReservationService;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| RentController
|--------------------------------------------------------------------------
|
| RentController je odgovaran za povezivanje logike
| izmedju rent view-a i neophodnih Modela
|
*/

class RentController extends Controller
{

    private $viewFolder = 'pages/rent';

    /**
     * Prikazi detalje o transakciji
     *
     * @param  Book $knjiga
     * @param  User $ucenik
     * @param  RentService $rentService
     * @return void
     */
    public function prikaziIzdavanjeDetalji(Book $knjiga, User $ucenik, RentService $rentService) {
        $viewName      = $this->viewFolder . '.izdavanjeDetalji';
        $viewNameError = $this->viewFolder . '.izdavanjeDetaljiError';

        $transakcija = $rentService->getTransakcija($knjiga->id, $ucenik->id);

        $viewModel = [
            'transakcija' => $transakcija
        ];

        $viewModelError = [
            'knjiga' => $knjiga,
            'ucenik' => $ucenik,
        ];
        
        if($transakcija != null) {
            return view($viewName, $viewModel);
        } else {
            return view($viewNameError, $viewModelError);
        }
    }

    /**
     * Prikazi knjige u prekoracenju
     *
     * @param  RentService $rentService
     * @param  UserService $userService
     * @return void
     */
    public function prikaziKnjigePrekoracenje(RentService $rentService, UserService $userService) {
        $viewName = $this->viewFolder . '.knjigePrekoracenje';

        $prekoracene = $rentService->getPrekoraceneKnjige()->paginate(7);

        $viewModel = [
            'prekoracene'  => $prekoracene,
            'ucenici'      => $userService->getUcenici()->get(),
            'bibliotekari' => $userService->getBibliotekari()->get(),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi izdate knjige
     *
     * @param  RentService $rentService
     * @param  UserService $userService
     * @return void
     */
    public function prikaziIzdateKnjige(RentService $rentService, UserService $userService) {
        $viewName = $this->viewFolder . '.izdateKnjige';

        // pokupi samo knjige sa statusom izdatata
        $izdate = $rentService->getIzdateKnjige()->paginate(7);

        $viewModel = [
            'izdate'       => $izdate,
            'ucenici'      => $userService->getUcenici()->get(),
            'bibliotekari' => $userService->getBibliotekari()->get(),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi vracene knjige
     *
     * @param  RentService $rentService
     * @param  UserService $userService
     * @return void
     */
    public function prikaziVraceneKnjige(RentService $rentService, UserService $userService) {
        $viewName = $this->viewFolder . '.vraceneKnjige';

        // pokupi samo knjige sa statusom izdatata
        $vracene = $rentService->getVraceneKnjige()->paginate(7);

        $viewModel = [
            'vracene'      => $vracene,
            'ucenici'      => $userService->getUcenici()->get(),
            'bibliotekari' => $userService->getBibliotekari()->get(),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi aktivne rezervacije
     *
     * @param  ReservationService $reservationService
     * @return void
     */
    public function prikaziAktivneRezervacije(ReservationService $reservationService) {
        $viewName = $this->viewFolder . '.aktivneRezervacije';

        $viewModel = [
            'aktivne' => $reservationService->getAktivneRezervacije()->paginate(7),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi arhivirane rezervacije
     *
     * @param  ReservationService $reservationService
     * @return void
     */
    public function prikaziArhiviraneRezervacije(ReservationService $reservationService) {
        $viewName = $this->viewFolder . '.arhiviraneRezervacije';

        $viewModel = [
            'arhivirane' => $reservationService->getArhiviraneRezervacije()->paginate(7)
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Izbrisi transakciju
     *
     * @param  Book $knjiga
     * @param  User $ucenik
     * @param  RentService $rentService
     * @param  UserService $userService
     * @return void
     */
    public function izbrisiTransakciju(Book $knjiga, User $ucenik, RentService $rentService, UserService $userService) {
        $viewName = $this->viewFolder . '.izdateKnjige';

        $rentService->deleteTransakcija($knjiga->id, $ucenik->id);
        $izdate = $rentService->getIzdateKnjige()->paginate(7);

        $viewModel = [
            'izdate'       => $izdate,
            'ucenici'      => $userService->getUcenici()->get(),
            'bibliotekari' => $userService->getBibliotekari()->get(),
        ];
        
        return view($viewName, $viewModel);
    }

    /**
     * Prikazi filtrirane izdate knjige
     *
     * @param  RentService $rentService
     * @param  UserService $userService
     * @return void
     */
    public function filterIzdateKnjige(RentService $rentService, UserService $userService) {
        $viewName = $this->viewFolder . '.izdateKnjige';

        $izdate = $rentService->filtirajIzdateKnjige();

        $viewModel = [
            'izdate'       => $izdate,
            'ucenici'      => $userService->getUcenici()->get(),
            'bibliotekari' => $userService->getBibliotekari()->get(),
        ];

        return view($viewName, $viewModel);

    }

    /**
     * Prikazi filtrirane izdate knjige
     *
     * @param  RentService $rentService
     * @param  UserService $userService
     * @return void
     */
    public function searchIzdateKnjige(RentService $rentService, UserService $userService) {
        $viewName = $this->viewFolder . '.izdateKnjige';

        $izdate = $rentService->searchIzdateKnjige();

        $viewModel = [
            'izdate'       => $izdate,
            'ucenici'      => $userService->getUcenici()->get(),
            'bibliotekari' => $userService->getBibliotekari()->get(),
        ];

        return view($viewName, $viewModel);

    }

    /**
     * Prikazi filtirirane vracene knjige
     *
     * @param  RentService $rentService
     * @param  UserService $userService
     * @return void
     */
    public function filterVraceneKnjige(RentService $rentService, UserService $userService) {
        $viewName = $this->viewFolder . '.vraceneKnjige';

        $vracene = $rentService->filtirajVraceneKnjige();

        $viewModal = [
            'vracene'      => $vracene,
            'ucenici'      => $userService->getUcenici()->get(),
            'bibliotekari' => $userService->getBibliotekari()->get(),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi filtrirane u prekoracenju
     *
     * @param  RentService $rentService
     * @param  UserService $userService
     * @return void
     */
    public function filterPrekoraceneKnjige(RentService $rentService, UserService $userService) {
        $viewName = $this->viewFolder . '.knjigePrekoracenje';

        $prekoracene = $rentService->filtirajPrekoraceneKnjige();

        $viewModal = [
            'prekoracene'  => $prekoracene,
            'ucenici'      => $userService->getUcenici()->get(),
            'bibliotekari' => $userService->getBibliotekari()->get(),
        ];

        return view($viewName, $viewModel);
    }

}
