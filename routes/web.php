<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//DASHBOARD - ROUTES
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'prikaziDashboard']);
Route::get('/dashboardAktivnost', [\App\Http\Controllers\DashboardController::class, 'prikaziDashboardAktivnost']);

//USER - ROUTES
Route::get('/bibliotekarProfile', [\App\Http\Controllers\UserController::class, 'prikaziBibliotekara']);
Route::get('/bibliotekari', [\App\Http\Controllers\UserController::class, 'prikaziBibliotekare']);
Route::get('/editBibliotekar', [\App\Http\Controllers\UserController::class, 'prikaziEditBibliotekar']);
Route::get('/editUcenik', [\App\Http\Controllers\UserController::class, 'prikaziEditUcenik']);
Route::get('/noviBibliotekar', [\App\Http\Controllers\UserController::class, 'prikaziNoviBibliotekar']);


//BOOK - ROUTES
Route::get('/editKnjiga', [\App\Http\Controllers\BookController::class, 'prikaziEditKnjiga']);
Route::get('/editKnjigaMultimedija', [\App\Http\Controllers\BookController::class, 'prikaziEditKnjigaMultimedija']);
Route::get('/editKnjigaSpecifikacija', [\App\Http\Controllers\BookController::class, 'prikaziEditKnjigaSpecifikacija']);
Route::get('/evidencijaKnjiga', [\App\Http\Controllers\BookController::class, 'prikaziEvidencijaKnjiga']);
Route::get('/evidencijaKnjigaMultimedija', [\App\Http\Controllers\BookController::class, 'prikaziEvidencijaKnjigaMultimedija']);
Route::get('/izdateKnjige', [\App\Http\Controllers\BookController::class, 'prikaziIzdateKnjige']);
Route::get('/knjigaOsnovniDetalji', [\App\Http\Controllers\BookController::class, 'prikaziKnjigaOsnovniDetalji']);
Route::get('/knjigaSpecifikacija', [\App\Http\Controllers\BookController::class, 'prikaziKnjigaSpecifikacija']);
Route::get('/novaKnjiga', [\App\Http\Controllers\BookController::class, 'prikaziNovaKnjiga']);
Route::get('/novaKnjigaMultimedija', [\App\Http\Controllers\BookController::class, 'prikaziNovaKnjigaMultimedija']);
Route::get('/novaKnjigaSpecifikacija', [\App\Http\Controllers\BookController::class, 'prikaziNovaKnjigaSpecifikacija']);


//RESERVATION - ROUTES
Route::get('/aktivneRezervacije', [\App\Http\Controllers\ReservationController::class, 'prikaziAktivneRezervacije']);
Route::get('/arhiviraneRezervacije', [\App\Http\Controllers\ReservationController::class, 'prikaziArhiviraneRezervacije']);
Route::get('/iznajmljivanjeAktivne', [\App\Http\Controllers\ReservationController::class, 'prikaziIznajmljivanjeAktivne']);
Route::get('/iznajmljivanjeArhivirane', [\App\Http\Controllers\ReservationController::class, 'prikaziIznajmljivanjeArhivirane']);

//RENT - ROUTES
Route::get('/izdajKnjigu', [\App\Http\Controllers\RentController::class, 'prikaziIzdajKnjigu']);
Route::get('/izdajKnjiguError', [\App\Http\Controllers\RentController::class, 'prikaziIzdajKnjiguError']);
Route::get('/izdavanjeDetalji', [\App\Http\Controllers\RentController::class, 'prikaziIzdavanjeDetalji']);
Route::get('/iznajmljivanjeIzdate', [\App\Http\Controllers\RentController::class, 'prikaziIznajmljivanjeIzdate']);
Route::get('/iznajmljivanjePrekoracenje', [\App\Http\Controllers\RentController::class, 'prikaziIznajmljivanjePrekoracenje']);
Route::get('/iznajmljivanjeVracene', [\App\Http\Controllers\RentController::class, 'prikaziIznajmljivanjeVracene']);
Route::get('/knjigePrekoracenje', [\App\Http\Controllers\RentController::class, 'prikaziKnjigePrekoracenje']);

//SCRIPT - ROUTES
Route::get('/editPismo', [\App\Http\Controllers\ScriptController::class, 'prikaziEditPismo']);


//FORMAT - ROUTES
Route::get('/editFormat', [\App\Http\Controllers\FormatController::class, 'prikaziEditFormat']);
Route::get('/noviFormat', [\App\Http\Controllers\FormatController::class, 'prikaziNoviFormat']);


//LANGUAGE - ROUTES


//BINDING - ROUTES
Route::get('/editPovez', [\App\Http\Controllers\BindingController::class, 'prikaziEditPovez']);
Route::get('/noviPovez', [\App\Http\Controllers\BindingController::class, 'prikaziNoviPovez']);


//PUBLISHER - ROUTES
Route::get('/editIzdavac', [\App\Http\Controllers\PublisherController::class, 'prikaziEditIzdavac']);
Route::get('/noviIzdavac', [\App\Http\Controllers\PublisherController::class, 'prikaziNoviIzdavac']);


//CATEGORY - ROUTES
Route::get('/editKategorija', [\App\Http\Controllers\CategoryController::class, 'prikaziEditKategorija']);
Route::get('/novaKategorija', [\App\Http\Controllers\CategoryController::class, 'prikaziNovaKategorija']);


//AUTHOR - ROUTES
Route::get('/autorProfile', [\App\Http\Controllers\AuthorController::class, 'prikaziAutora']);
Route::get('/autori', [\App\Http\Controllers\AuthorController::class, 'prikaziAutore']);
Route::get('/editAutor', [\App\Http\Controllers\AuthorController::class, 'prikaziEditAutor']);
Route::get('/noviAutor', [\App\Http\Controllers\AuthorController::class, 'prikaziNoviAutor']);


//GALLERY - ROUTES


//GENRE - ROUTES
Route::get('/editZanr', [\App\Http\Controllers\GenreController::class, 'prikaziEditZanr']);



require __DIR__.'/auth.php';
