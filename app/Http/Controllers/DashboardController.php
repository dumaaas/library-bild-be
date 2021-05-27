<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use App\Models\Rent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\DashboardService;
use App\Services\BookService;
use App\Services\RentService;
use App\Services\ReservationService;
use App\Services\UserService;
use Illuminate\Http\Response;
use Symfony\Component\Console\Input\Input;

/*
|--------------------------------------------------------------------------
| DashboardController
|--------------------------------------------------------------------------
|
| DashboardController je odgovaran za povezivanje logike
| izmedju dashboard view-a i neophodnih Modela
|
*/

class DashboardController extends Controller
{
    private $viewFolder = 'pages/dashboard';

    /**
     * Prikazi dashboard
     *
     * @param  DashboardService $dashboardService
     * @return void
     */
    public function prikaziDashboard(DashboardService $dashboardService, ReservationService $reservationService, RentService $rentService) {
        $viewName = $this->viewFolder . '.dashboard';

        $viewModel = [
            'rezervacije'    => $dashboardService->getLatestReservation(),
            'aktivnosti'     => $dashboardService->getLatestActivities(),
            'prekoraceneNum' => $rentService->getPrekoraceneKnjige()->count(),
            'izdateNum'      => $rentService->getIzdateKnjige()->count(),
            'rezervisaneNum' => $reservationService->getRezervisaneKnjige()->count(),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi sve aktivnosti
     *
     * @param  DashboardService $dashboardService
     * @param  BookService $bookService
     * @param  UserService $userService
     * @return void
     */
    public function prikaziDashboardAktivnost(DashboardService $dashboardService, BookService $bookService, UserService $userService) {
        $viewName = $this->viewFolder . '.dashboardAktivnost';

        $viewModel = [
            'aktivnosti'   => $dashboardService->getActivities(),
            'knjiga'       => null,
            'ucenici'      => $userService->getUcenici()->get(),
            'bibliotekari' => $userService->getBibliotekari()->get(),
            'knjige'       => $bookService->getBooks(),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi sve aktivnosti kod konkretne knjige
     *
     * @param  Book $knjiga
     * @param  DashboardService $dashboardService
     * @param  BookService $bookService
     * @param  UserService $userService
     * @return void
     */
    public function prikaziDashboardAktivnostKonkretneKnjige(Book $knjiga, DashboardService $dashboardService, BookService $bookService, UserService $userService) {
        $viewName = $this->viewFolder . '.dashboardAktivnost';

        $viewModel = [
            'aktivnosti'   => $dashboardService->getBookActivity($knjiga->id),
            'knjiga'       => $knjiga,
            'ucenici'      => $userService->getUcenici()->get(),
            'bibliotekari' => $userService->getBibliotekari()->get(),
            'knjige'       => $bookService->getBooks(),
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Filtriraj sve aktivnosti
     *
     * @param  Request $request
     * @param  DashboardService $dashboardService
     * @param  BookService $bookService
     * @param  UserService $userService
     * @return void
     */
    public function filterAktivnosti(Request $request, DashboardService $dashboardService, BookService $bookService, UserService $userService) {
        
        $aktivnosti = $dashboardService->filterActivities(
            $request->ucenici, 
            $request->bibliotekari, 
            $request->knjige,
            $request->datumOd, 
            $request->datumDo
        );

        $responseJson = [
            "aktivnosti"   => $aktivnosti,
            'knjiga'       => null,
            'ucenici'      => $userService->getUcenici()->get(),
            'bibliotekari' => $userService->getBibliotekari()->get(),
            'knjige'       => $bookService->getBooks(),
        ];

        return response()->json($responseJson);
    }
}
