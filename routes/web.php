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
Route::get('/ucenik', [\App\Http\Controllers\UserController::class, 'prikaziUcenike']);
Route::get('/ucenikProfile', [\App\Http\Controllers\UserController::class, 'prikaziUcenikProfile']);
Route::get('/noviUcenik', [\App\Http\Controllers\UserController::class, 'prikaziNovogUcenika']);


//BOOK - ROUTES
Route::get('/editKnjiga', [\App\Http\Controllers\BookController::class, 'prikaziEditKnjiga']);
Route::get('/editKnjigaMultimedija', [\App\Http\Controllers\BookController::class, 'prikaziEditKnjigaMultimedija']);
Route::get('/editKnjigaSpecifikacija', [\App\Http\Controllers\BookController::class, 'prikaziEditKnjigaSpecifikacija']);
Route::get('/evidencijaKnjiga', [\App\Http\Controllers\BookController::class, 'prikaziEvidencijaKnjiga']);
Route::get('/evidencijaKnjigaMultimedija', [\App\Http\Controllers\BookController::class, 'prikaziEvidencijaKnjigaMultimedija']);
Route::get('/knjigaOsnovniDetalji', [\App\Http\Controllers\BookController::class, 'prikaziKnjigaOsnovniDetalji']);
Route::get('/knjigaSpecifikacija', [\App\Http\Controllers\BookController::class, 'prikaziKnjigaSpecifikacija']);
Route::get('/novaKnjiga', [\App\Http\Controllers\BookController::class, 'prikaziNovaKnjiga']);
Route::get('/novaKnjigaMultimedija', [\App\Http\Controllers\BookController::class, 'prikaziNovaKnjigaMultimedija']);
Route::get('/novaKnjigaSpecifikacija', [\App\Http\Controllers\BookController::class, 'prikaziNovaKnjigaSpecifikacija']);
Route::get('/vratiKnjigu', [\App\Http\Controllers\BookController::class, 'prikaziVratiKnjigu']);
Route::get('/otpisiKnjigu', [\App\Http\Controllers\BookController::class, 'prikaziOtpisiKnjigu']);
Route::get('/rezervisiKnjigu', [\App\Http\Controllers\BookController::class, 'prikaziRezervisiKnjigu']);
Route::get('/izdajKnjigu', [\App\Http\Controllers\BookController::class, 'prikaziIzdajKnjigu']);
Route::get('/izdajKnjiguError', [\App\Http\Controllers\BookController::class, 'prikaziIzdajKnjiguError']);


//RESERVATION - ROUTES
Route::get('/aktivneRezervacije', [\App\Http\Controllers\ReservationController::class, 'prikaziAktivneRezervacije']);
Route::get('/arhiviraneRezervacije', [\App\Http\Controllers\ReservationController::class, 'prikaziArhiviraneRezervacije']);
Route::get('/iznajmljivanjeAktivne', [\App\Http\Controllers\ReservationController::class, 'prikaziIznajmljivanjeAktivne']);
Route::get('/iznajmljivanjeArhivirane', [\App\Http\Controllers\ReservationController::class, 'prikaziIznajmljivanjeArhivirane']);
Route::get('/ucenikAktivne', [\App\Http\Controllers\ReservationController::class, 'prikaziUcenikAktivne']);
Route::get('/ucenikArhivirane', [\App\Http\Controllers\ReservationController::class, 'prikaziUcenikArhivirane']);

//RENT - ROUTES
Route::get('/izdavanjeDetalji', [\App\Http\Controllers\RentController::class, 'prikaziIzdavanjeDetalji']);
Route::get('/iznajmljivanjeIzdate', [\App\Http\Controllers\RentController::class, 'prikaziIznajmljivanjeIzdate']);
Route::get('/iznajmljivanjePrekoracenje', [\App\Http\Controllers\RentController::class, 'prikaziIznajmljivanjePrekoracenje']);
Route::get('/iznajmljivanjeVracene', [\App\Http\Controllers\RentController::class, 'prikaziIznajmljivanjeVracene']);
Route::get('/knjigePrekoracenje', [\App\Http\Controllers\RentController::class, 'prikaziKnjigePrekoracenje']);
Route::get('/ucenikIzdate', [\App\Http\Controllers\RentController::class, 'prikaziUcenikIzdate']);
Route::get('/ucenikVracene', [\App\Http\Controllers\RentController::class, 'prikaziUcenikVracene']);
Route::get('/ucenikPrekoracenje', [\App\Http\Controllers\RentController::class, 'prikaziUcenikPrekoracenje']);
Route::get('/izdateKnjige', [\App\Http\Controllers\RentController::class, 'prikaziIzdateKnjige']);
Route::get('/vraceneKnjige', [\App\Http\Controllers\RentController::class, 'prikaziVraceneKnjige']);


//SCRIPT - ROUTES
Route::get('/editPismo', [\App\Http\Controllers\ScriptController::class, 'prikaziEditPismo']);
Route::get('/settingsPismo', [\App\Http\Controllers\ScriptController::class, 'prikaziSettingsPismo']);
Route::get('/novoPismo', [\App\Http\Controllers\ScriptController::class, 'prikaziNovoPismo']);


//FORMAT - ROUTES
Route::get('/editFormat', [\App\Http\Controllers\FormatController::class, 'prikaziEditFormat']);
Route::get('/noviFormat', [\App\Http\Controllers\FormatController::class, 'prikaziNoviFormat']);
Route::get('/settingsFormat', [\App\Http\Controllers\FormatController::class, 'prikaziSettingsFormat']);


//LANGUAGE - ROUTES


//BINDING - ROUTES
Route::get('/editPovez', [\App\Http\Controllers\BindingController::class, 'prikaziEditPovez']);
Route::get('/noviPovez', [\App\Http\Controllers\BindingController::class, 'prikaziNoviPovez']);
Route::get('/settingsPovez', [\App\Http\Controllers\BindingController::class, 'prikaziSettingsPovez']);


//PUBLISHER - ROUTES
Route::get('/editIzdavac', [\App\Http\Controllers\PublisherController::class, 'prikaziEditIzdavac']);
Route::get('/noviIzdavac', [\App\Http\Controllers\PublisherController::class, 'prikaziNoviIzdavac']);
Route::get('/settingsIzdavac', [\App\Http\Controllers\PublisherController::class, 'prikaziSettingsIzdavac']);


//CATEGORY - ROUTES
Route::get('/editKategorija', [\App\Http\Controllers\CategoryController::class, 'prikaziEditKategorija']);
Route::get('/novaKategorija', [\App\Http\Controllers\CategoryController::class, 'prikaziNovaKategorija']);
Route::get('/settingsKategorije', [\App\Http\Controllers\CategoryController::class, 'prikaziSettingsKategorije']);


//AUTHOR - ROUTES
Route::get('/autorProfile', [\App\Http\Controllers\AuthorController::class, 'prikaziAutora']);
Route::get('/autori', [\App\Http\Controllers\AuthorController::class, 'prikaziAutore']);
Route::get('/editAutor', [\App\Http\Controllers\AuthorController::class, 'prikaziEditAutor']);
Route::get('/noviAutor', [\App\Http\Controllers\AuthorController::class, 'prikaziNoviAutor']);


//GALLERY - ROUTES


//GENRE - ROUTES
Route::get('/editZanr', [\App\Http\Controllers\GenreController::class, 'prikaziEditZanr']);
Route::get('/settingsZanrovi', [\App\Http\Controllers\GenreController::class, 'prikaziSettingsZanrovi']);
Route::get('/noviZanr', [\App\Http\Controllers\GenreController::class, 'prikaziNoviZanr']);


//POLICY - ROUTES
Route::get('/settingsPolisa', [\App\Http\Controllers\PolicyController::class, 'prikaziSettingsPolisa']);

require __DIR__.'/auth.php';
