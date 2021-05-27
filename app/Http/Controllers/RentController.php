<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\RentStatus;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Book;
use App\Services\RentService;
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
     * @return void
     */
    public function prikaziKnjigePrekoracenje(RentService $rentService) {
        $viewName = $this->viewFolder . '.knjigePrekoracenje';

        $prekoracene = $rentService->getPrekoraceneKnjige()->paginate(7);

        $viewModel = [
            'prekoracene'  => $prekoracene,
            //kad se zavrsi UserService -> izmijeniti             
            'ucenici'      => DB::table('users')->where('userType_id', '=', 3)->get(),
            'bibliotekari' => DB::table('users')->where('userType_id', '=', 2)->get(),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi izdate knjige
     *
     * @param  RentService $rentService
     * @return void
     */
    public function prikaziIzdateKnjige(RentService $rentService) {
        $viewName = $this->viewFolder . '.izdateKnjige';

        // pokupi samo knjige sa statusom izdatata
        $izdate = $rentService->getIzdateKnjige()->paginate(7);

        $viewModel = [
            'izdate'       => $izdate,
            //kad se zavrsi UserService -> izmijeniti             
            'ucenici'      => DB::table('users')->where('userType_id', '=', 3)->get(),
            'bibliotekari' => DB::table('users')->where('userType_id', '=', 2)->get(),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi vracene knjige
     *
     * @param  RentService $rentService
     * @return void
     */
    public function prikaziVraceneKnjige(RentService $rentService) {
        $viewName = $this->viewFolder . '.vraceneKnjige';

        // pokupi samo knjige sa statusom izdatata
        $vracene = $rentService->getVraceneKnjige()->paginate(7);

        $viewModel = [
            'vracene'      => $vracene,
            //kad se zavrsi UserService -> izmijeniti             
            'ucenici'      => DB::table('users')->where('userType_id', '=', 3)->get(),
            'bibliotekari' => DB::table('users')->where('userType_id', '=', 2)->get(),
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
        $viewName = $this->viewFolder . '.vraceneKnjige';

        $viewModel = [
            'aktivne' => $reservationService->getAktivneRezervacije->paginate(7),
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
        $viewName = $this->viewFolder . '.vraceneKnjige';

        $viewModel = [
            'arhivirane' => $reservationService->getArhiviraneRezervacije->paginate(7)
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Izbrisi transakciju
     *
     * @param  Book $knjiga
     * @param  User $ucenik
     * @param  RentService $rentService
     * @return void
     */
    public function izbrisiTransakciju(Book $knjiga, User $ucenik, RentService $rentService) {
        $viewName = $this->viewFolder . '.izdateKnjige';

        $rentService->deleteTransakcija($knjiga->id, $ucenik->id);
        $izdate = $rentService->getIzdateKnjige()->paginate(7);

        $viewModel = [
            'izdate'       => $izdate,
            //kad se zavrsi UserService -> izmijeniti             
            'ucenici'      => DB::table('users')->where('userType_id', '=', 3)->get(),
            'bibliotekari' => DB::table('users')->where('userType_id', '=', 2)->get(),
        ];
        
        return view($viewName, $viewModel);
    }

    /**
     * Prikazi filtrirane izdate knjige
     *
     * @param  RentService $rentService
     * @return void
     */
    public function filterIzdateKnjige(RentService $rentService) {
        $viewName = $this->viewFolder . '.izdateKnjige';

        $izdate = $rentService->filtirajIzdateKnjige();

        $viewModal = [
            'izdate'       => $izdate,
            //kad se zavrsi UserService -> izmijeniti             
            'ucenici'      => DB::table('users')->where('userType_id', '=', 3)->get(),
            'bibliotekari' => DB::table('users')->where('userType_id', '=', 2)->get(),
        ];

        return view($viewName, $viewModel);

    }

    /**
     * Prikazi filtirirane vracene knjige
     *
     * @param  RentService $rentService
     * @return void
     */
    public function filterVraceneKnjige() {
        $viewName = $this->viewFolder . '.vraceneKnjige';

        $vracene = $rentService->filtirajVraceneKnjige();

        $viewModal = [
            'vracene'       => $vracene,
            //kad se zavrsi UserService -> izmijeniti             
            'ucenici'      => DB::table('users')->where('userType_id', '=', 3)->get(),
            'bibliotekari' => DB::table('users')->where('userType_id', '=', 2)->get(),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi filtrirane u prekoracenju
     *
     * @param  RentService $rentService
     * @return void
     */
    public function filterPrekoraceneKnjige() {
        $viewName = $this->viewFolder . '.knjigePrekoracenje';

        $prekoracene = $rentService->filtirajPrekoraceneKnjige();

        $viewModal = [
            'prekoracene'       => $prekoracene,
            //kad se zavrsi UserService -> izmijeniti             
            'ucenici'      => DB::table('users')->where('userType_id', '=', 3)->get(),
            'bibliotekari' => DB::table('users')->where('userType_id', '=', 2)->get(),
        ];

        return view($viewName, $viewModel);
    }

}
