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
Route::get('/ucenikIzdate', [\App\Http\Controllers\UserController::class, 'prikaziUcenikIzdate']);
Route::get('/ucenikVracene', [\App\Http\Controllers\UserController::class, 'prikaziUcenikVracene']);
Route::get('/ucenikPrekoracenje', [\App\Http\Controllers\UserController::class, 'prikaziUcenikPrekoracenje']);
Route::get('/ucenikAktivne', [\App\Http\Controllers\UserController::class, 'prikaziUcenikAktivne']);
Route::get('/ucenikArhivirane', [\App\Http\Controllers\UserController::class, 'prikaziUcenikArhivirane']);
Route::get('/bibliotekarProfile/{bibliotekar}', [\App\Http\Controllers\UserController::class, 'prikaziBibliotekara'])->name('bibliotekarProfile');


//BOOK - ROUTES
Route::get('/editKnjiga', [\App\Http\Controllers\BookController::class, 'prikaziEditKnjiga']);
Route::get('/editKnjigaMultimedija', [\App\Http\Controllers\BookController::class, 'prikaziEditKnjigaMultimedija']);
Route::get('/editKnjigaSpecifikacija', [\App\Http\Controllers\BookController::class, 'prikaziEditKnjigaSpecifikacija']);
Route::get('/evidencijaKnjiga', [\App\Http\Controllers\BookController::class, 'prikaziEvidencijaKnjiga'])->name('evidencijaKnjiga');
Route::get('/evidencijaKnjigaMultimedija/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziEvidencijaKnjigaMultimedija'])->name('evidencijaKnjigaMultimedija');
Route::get('/knjigaOsnovniDetalji/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziKnjigaOsnovniDetalji'])->name('knjigaOsnovniDetalji');
Route::get('/knjigaSpecifikacija/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziKnjigaSpecifikacija'])->name('knjigaSpecifikacija');
Route::get('/novaKnjiga', [\App\Http\Controllers\BookController::class, 'prikaziNovaKnjiga'])->name('novaKnjiga');
Route::get('/novaKnjigaMultimedija', [\App\Http\Controllers\BookController::class, 'prikaziNovaKnjigaMultimedija']);
Route::get('/novaKnjigaSpecifikacija', [\App\Http\Controllers\BookController::class, 'prikaziNovaKnjigaSpecifikacija']);
Route::get('/vratiKnjigu', [\App\Http\Controllers\BookController::class, 'prikaziVratiKnjigu']);
Route::get('/otpisiKnjigu', [\App\Http\Controllers\BookController::class, 'prikaziOtpisiKnjigu']);
Route::get('/rezervisiKnjigu', [\App\Http\Controllers\BookController::class, 'prikaziRezervisiKnjigu']);
Route::get('/izdajKnjigu', [\App\Http\Controllers\BookController::class, 'prikaziIzdajKnjigu']);
Route::get('/izdajKnjiguError', [\App\Http\Controllers\BookController::class, 'prikaziIzdajKnjiguError']);
Route::get('/iznajmljivanjeIzdate/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziIznajmljivanjeIzdate'])->name('iznajmljivanjeIzdate');
Route::get('/iznajmljivanjePrekoracenje/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziIznajmljivanjePrekoracenje'])->name('iznajmljivanjePrekoracenje');
Route::get('/iznajmljivanjeVracene/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziIznajmljivanjeVracene'])->name('iznajmljivanjeVracene');
Route::get('/iznajmljivanjeAktivne/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziIznajmljivanjeAktivne'])->name('iznajmljivanjeAktivne');
Route::get('/iznajmljivanjeArhivirane/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziIznajmljivanjeArhivirane'])->name('iznajmljivanjeArhivirane');
Route::post('/sacuvajKnjigu', [\App\Http\Controllers\BookController::class, 'sacuvajKnjigu'])->name('sacuvajKnjigu');
Route::get('/izbrisiKnjigu/{knjiga}', [\App\Http\Controllers\BookController::class, 'izbrisiKnjigu'])->name('izbrisiKnjigu');

//RESERVATION - ROUTES


//RENT - ROUTES
Route::get('/izdavanjeDetalji', [\App\Http\Controllers\RentController::class, 'prikaziIzdavanjeDetalji']);
Route::get('/knjigePrekoracenje', [\App\Http\Controllers\RentController::class, 'prikaziKnjigePrekoracenje']);
Route::get('/izdateKnjige', [\App\Http\Controllers\RentController::class, 'prikaziIzdateKnjige']);
Route::get('/vraceneKnjige', [\App\Http\Controllers\RentController::class, 'prikaziVraceneKnjige']);
Route::get('/aktivneRezervacije', [\App\Http\Controllers\RentController::class, 'prikaziAktivneRezervacije']);
Route::get('/arhiviraneRezervacije', [\App\Http\Controllers\RentController::class, 'prikaziArhiviraneRezervacije']);


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
Route::get('/editPovez/{povez}', [\App\Http\Controllers\BindingController::class, 'prikaziEditPovez'])->name('editPovez');
Route::get('/noviPovez', [\App\Http\Controllers\BindingController::class, 'prikaziNoviPovez'])->name('noviPovez');
Route::get('/settingsPovez', [\App\Http\Controllers\BindingController::class, 'prikaziSettingsPovez'])->name('settingsPovez');
Route::post('/sacuvajPovez', [\App\Http\Controllers\BindingController::class, 'sacuvajPovez'])->name('sacuvajPovez');
Route::post('/izmijeniPovez/{povez}', [\App\Http\Controllers\BindingController::class, 'izmijeniPovez'])->name('izmijeniPovez');
Route::get('/izbrisiPovez/{povez}', [\App\Http\Controllers\BindingController::class, 'izbrisiPovez'])->name('izbrisiPovez');


//PUBLISHER - ROUTES
Route::get('/editIzdavac/{izdavac}', [\App\Http\Controllers\PublisherController::class, 'prikaziEditIzdavac'])->name('editIzdavac');
Route::get('/noviIzdavac', [\App\Http\Controllers\PublisherController::class, 'prikaziNoviIzdavac'])->name('prikaziNoviIzdavac');
Route::get('/settingsIzdavac', [\App\Http\Controllers\PublisherController::class, 'prikaziSettingsIzdavac'])->name('settingsIzdavac');
Route::post('/izmijeniIzdavaca/{izdavac}', [\App\Http\Controllers\PublisherController::class, 'izmijeniIzdavaca'])->name('izmijeniIzdavaca');
Route::get('/izbrisiIzdavaca/{izdavac}', [\App\Http\Controllers\PublisherController::class, 'izbrisiIzdavaca'])->name('izbrisiIzdavaca');
Route::post('/sacuvajIzdavaca}', [\App\Http\Controllers\PublisherController::class, 'sacuvajIzdavaca'])->name('sacuvajIzdavaca');


//CATEGORY - ROUTES
Route::get('/editKategorija', [\App\Http\Controllers\CategoryController::class, 'prikaziEditKategorija']);
Route::get('/novaKategorija', [\App\Http\Controllers\CategoryController::class, 'prikaziNovaKategorija']);
Route::get('/settingsKategorije', [\App\Http\Controllers\CategoryController::class, 'prikaziSettingsKategorije']);


//AUTHOR - ROUTES
Route::get('/autorProfile/{autor}', [\App\Http\Controllers\AuthorController::class, 'prikaziAutora'])->name('autorProfile');
Route::get('/autori', [\App\Http\Controllers\AuthorController::class, 'prikaziAutore']);
Route::get('/editAutor/{autor}', [\App\Http\Controllers\AuthorController::class, 'prikaziEditAutor'])->name('editAutor');
Route::post('/editAutor/{autor}/update', [\App\Http\Controllers\AuthorController::class, 'izmijeniAutora'])->name('updateAutor');
Route::get('/noviAutor', [\App\Http\Controllers\AuthorController::class, 'prikaziNoviAutor'])->name('noviAutor');
Route::get('/deleteAutor/{autor}', [\App\Http\Controllers\AuthorController::class, 'izbrisiAutora'])->name('deleteAutor');
Route::post('/sacuvajAutora', [\App\Http\Controllers\AuthorController::class, 'sacuvajAutora'])->name('sacuvajAutora');


//GALLERY - ROUTES


//GENRE - ROUTES
Route::get('/editZanr', [\App\Http\Controllers\GenreController::class, 'prikaziEditZanr']);
Route::get('/settingsZanrovi', [\App\Http\Controllers\GenreController::class, 'prikaziSettingsZanrovi']);
Route::get('/noviZanr', [\App\Http\Controllers\GenreController::class, 'prikaziNoviZanr']);


//POLICY - ROUTES
Route::get('/settingsPolisa', [\App\Http\Controllers\PolicyController::class, 'prikaziSettingsPolisa'])->name('settingsPolisa');

require __DIR__.'/auth.php';
