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

Route::group(['middleware' => 'auth'], function() {

    //DASHBOARD - ROUTES
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'prikaziDashboard']);
    Route::get('/dashboardAktivnost', [\App\Http\Controllers\DashboardController::class, 'prikaziDashboardAktivnost'])->name('dashboardAktivnost');
    Route::get('/dashboardAktivnostKonkretneKnjige/{knjiga}', [\App\Http\Controllers\DashboardController::class, 'prikaziDashboardAktivnostKonkretneKnjige'])->name('dashboardAktivnostKonkretneKnjige');
    Route::post('/filterAktivnosti', [\App\Http\Controllers\DashboardController::class, 'filterAktivnosti'])->name('filterAktivnosti');

    //USER - ROUTES
    Route::get('/bibliotekarProfile/{bibliotekar}', [\App\Http\Controllers\UserController::class, 'prikaziBibliotekara'])->name('bibliotekarProfile');
    Route::get('/bibliotekari', [\App\Http\Controllers\UserController::class, 'prikaziBibliotekare']);
    Route::get('/editBibliotekar{bibliotekar}', [\App\Http\Controllers\UserController::class, 'prikaziEditBibliotekar'])->name('editBibliotekar');
    Route::post('/editBibliotekar/{bibliotekar}/update', [\App\Http\Controllers\UserController::class, 'izmijeniBibliotekara'])->name('updateBibliotekar');
    Route::get('/deleteBibliotekar/{bibliotekar}', [\App\Http\Controllers\UserController::class, 'izbrisiBibliotekara'])->name('deleteBibliotekar');
    Route::get('/noviBibliotekar', [\App\Http\Controllers\UserController::class, 'prikaziNoviBibliotekar'])->name('noviBibliotekar');
    Route::post('/sacuvajBibliotekara', [\App\Http\Controllers\UserController::class, 'sacuvajBibliotekara'])->name('sacuvajBibliotekara');
    Route::get('/ucenik', [\App\Http\Controllers\UserController::class, 'prikaziUcenike']);
    Route::get('/ucenikProfile/{ucenik}', [\App\Http\Controllers\UserController::class, 'prikaziUcenikProfile'])->name('ucenikProfile');
    Route::get('/editUcenik/{ucenik}', [\App\Http\Controllers\UserController::class, 'prikaziEditUcenik'])->name('editUcenik');
    Route::post('/editUcenik/{ucenik}/update', [\App\Http\Controllers\UserController::class, 'izmjeniUcenika'])->name('updateUcenik');
    Route::get('/noviUcenik', [\App\Http\Controllers\UserController::class, 'prikaziNovogUcenika'])->name('noviUcenik');
    Route::get('/deleteUcenik/{ucenik}', [\App\Http\Controllers\UserController::class, 'izbrisiUcenika'])->name('deleteUcenik');
    Route::post('/sacuvajUcenika', [\App\Http\Controllers\UserController::class, 'sacuvajUcenika'])->name('sacuvajUcenika');
    Route::get('/ucenikIzdate/{ucenik}', [\App\Http\Controllers\UserController::class, 'prikaziUcenikIzdate'])->name('ucenikIzdate');
    Route::get('/ucenikVracene/{ucenik}', [\App\Http\Controllers\UserController::class, 'prikaziUcenikVracene'])->name('ucenikVracene');
    Route::get('/ucenikPrekoracenje/{ucenik}', [\App\Http\Controllers\UserController::class, 'prikaziUcenikPrekoracenje'])->name('ucenikPrekoracenje');
    Route::get('/ucenikAktivne/{ucenik}', [\App\Http\Controllers\UserController::class, 'prikaziUcenikAktivne'])->name('ucenikAktivne');
    Route::get('/ucenikArhivirane/{ucenik}', [\App\Http\Controllers\UserController::class, 'prikaziUcenikArhivirane'])->name('ucenikArhivirane');


    //BOOK - ROUTES
    Route::get('/editKnjiga/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziEditKnjiga'])->name('editKnjiga');
    Route::get('/editKnjigaMultimedija', [\App\Http\Controllers\BookController::class, 'prikaziEditKnjigaMultimedija']);
    Route::get('/editKnjigaSpecifikacija', [\App\Http\Controllers\BookController::class, 'prikaziEditKnjigaSpecifikacija']);
    Route::get('/evidencijaKnjiga', [\App\Http\Controllers\BookController::class, 'prikaziEvidencijaKnjiga'])->name('evidencijaKnjiga');
    Route::get('/evidencijaKnjigaMultimedija/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziEvidencijaKnjigaMultimedija'])->name('evidencijaKnjigaMultimedija');
    Route::get('/knjigaOsnovniDetalji/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziKnjigaOsnovniDetalji'])->name('knjigaOsnovniDetalji');
    Route::get('/knjigaSpecifikacija/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziKnjigaSpecifikacija'])->name('knjigaSpecifikacija');
    Route::get('/novaKnjiga', [\App\Http\Controllers\BookController::class, 'prikaziNovaKnjiga'])->name('novaKnjiga');
    Route::get('/novaKnjigaMultimedija', [\App\Http\Controllers\BookController::class, 'prikaziNovaKnjigaMultimedija']);
    Route::get('/novaKnjigaSpecifikacija', [\App\Http\Controllers\BookController::class, 'prikaziNovaKnjigaSpecifikacija']);
    Route::get('/vratiKnjigu/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziVratiKnjigu'])->name('vratiKnjigu');
    Route::get('/otpisiKnjigu/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziOtpisiKnjigu'])->name('otpisiKnjigu');;
    Route::get('/rezervisiKnjigu/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziRezervisiKnjigu'])->name('rezervisiKnjigu');
    Route::post('/rezervisiKnjigu/{knjiga}/sacuvajRezervisanje', [\App\Http\Controllers\BookController::class, 'sacuvajRezervisanje'])->name('sacuvajRezervisanje');
    Route::get('/izdajKnjigu/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziIzdajKnjigu'])->name('izdajKnjigu');
    Route::post('/izdajKnjigu/{knjiga}/sacuvajIzdavanje', [\App\Http\Controllers\BookController::class, 'sacuvajIzdavanje'])->name('sacuvajIzdavanje');
    Route::get('/iznajmljivanjeIzdate/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziIznajmljivanjeIzdate'])->name('iznajmljivanjeIzdate');
    Route::get('/iznajmljivanjePrekoracenje/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziIznajmljivanjePrekoracenje'])->name('iznajmljivanjePrekoracenje');
    Route::get('/iznajmljivanjeVracene/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziIznajmljivanjeVracene'])->name('iznajmljivanjeVracene');
    Route::get('/iznajmljivanjeAktivne/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziIznajmljivanjeAktivne'])->name('iznajmljivanjeAktivne');
    Route::get('/iznajmljivanjeArhivirane/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziIznajmljivanjeArhivirane'])->name('iznajmljivanjeArhivirane');
    Route::post('/sacuvajKnjigu', [\App\Http\Controllers\BookController::class, 'sacuvajKnjigu'])->name('sacuvajKnjigu');
    Route::get('/izbrisiKnjigu/{knjiga}', [\App\Http\Controllers\BookController::class, 'izbrisiKnjigu'])->name('izbrisiKnjigu');
    Route::post('/editKnjiga/{knjiga}/update', [\App\Http\Controllers\BookController::class, 'updateKnjiga'])->name('updateKnjiga');

    //RESERVATION - ROUTES

    //RENT - ROUTES
    Route::get('/izdavanjeDetalji/{knjiga}/{ucenik}', [\App\Http\Controllers\RentController::class, 'prikaziIzdavanjeDetalji'])->name('izdavanjeDetalji');
    Route::get('/knjigePrekoracenje', [\App\Http\Controllers\RentController::class, 'prikaziKnjigePrekoracenje'])->name('knjigePrekoracenje');
    Route::get('/izdateKnjige', [\App\Http\Controllers\RentController::class, 'prikaziIzdateKnjige'])->name('izdateKnjige');
    Route::get('/vraceneKnjige', [\App\Http\Controllers\RentController::class, 'prikaziVraceneKnjige'])->name('vraceneKnjige');
    Route::get('/aktivneRezervacije', [\App\Http\Controllers\RentController::class, 'prikaziAktivneRezervacije'])->name('aktivneRezervacije');
    Route::get('/arhiviraneRezervacije', [\App\Http\Controllers\RentController::class, 'prikaziArhiviraneRezervacije'])->name('arhiviraneRezervacije');
    Route::get('/izbrisiTransakciju/{knjiga}/{ucenik}', [\App\Http\Controllers\RentController::class, 'izbrisiTransakciju'])->name('izbrisiTransakciju');

    //SCRIPT - ROUTES
    Route::get('/editPismo/{pismo}', [\App\Http\Controllers\ScriptController::class, 'prikaziEditPismo'])->name('editPismo');
    Route::get('/novoPismo', [\App\Http\Controllers\ScriptController::class, 'prikaziNovoPismo'])->name('novoPismo');
    Route::get('/settingsPismo', [\App\Http\Controllers\ScriptController::class, 'prikaziSettingsPismo'])->name('settingsPismo');
    Route::post('/sacuvajPismo', [\App\Http\Controllers\ScriptController::class, 'sacuvajPismo'])->name('sacuvajPismo');
    Route::post('/izmijeniPismo/{pismo}', [\App\Http\Controllers\ScriptController::class, 'izmijeniPismo'])->name('izmijeniPismo');
    Route::get('/izbrisiPismo/{pismo}', [\App\Http\Controllers\ScriptController::class, 'izbrisiPismo'])->name('izbrisiPismo');


    //FORMAT - ROUTES
    Route::get('/editFormat/{format}', [\App\Http\Controllers\FormatController::class, 'prikaziEditFormat'])->name('editFormat');
    Route::get('/noviFormat', [\App\Http\Controllers\FormatController::class, 'prikaziNoviFormat'])->name('noviFormat');
    Route::get('/settingsFormat', [\App\Http\Controllers\FormatController::class, 'prikaziSettingsFormat'])->name('settingsFormat');
    Route::post('/sacuvajFormat', [\App\Http\Controllers\FormatController::class, 'sacuvajFormat'])->name('sacuvajFormat');
    Route::post('/izmijeniFormat/{format}', [\App\Http\Controllers\FormatController::class, 'izmijeniFormat'])->name('izmijeniFormat');
    Route::get('/izbrisiFormat/{format}', [\App\Http\Controllers\FormatController::class, 'izbrisiFormat'])->name('izbrisiFormat');


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
    Route::get('/editKategorija/{kategorija}', [\App\Http\Controllers\CategoryController::class, 'prikaziEditKategorija'])->name('editKategorija');
    Route::get('/novaKategorija', [\App\Http\Controllers\CategoryController::class, 'prikaziNovaKategorija'])->name('novaKategorija');
    Route::get('/settingsKategorije', [\App\Http\Controllers\CategoryController::class, 'prikaziSettingsKategorije'])->name('settingsKategorije');
    Route::post('/sacuvajKategoriju', [\App\Http\Controllers\CategoryController::class, 'sacuvajKategoriju'])->name('sacuvajKategoriju');
    Route::post('/izmijeniKategoriju/{kategorija}', [\App\Http\Controllers\CategoryController::class, 'izmijeniKategoriju'])->name('izmijeniKategoriju');
    Route::get('/izbrisiKategoriju/{kategorija}', [\App\Http\Controllers\CategoryController::class, 'izbrisiKategoriju'])->name('izbrisiKategoriju');


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
    Route::get('/editZanr{zanr}', [\App\Http\Controllers\GenreController::class, 'prikaziEditZanr'])->name('editZanr');
    Route::get('/noviZanr', [\App\Http\Controllers\GenreController::class, 'prikaziNoviZanr'])->name('noviZanr');
    Route::get('/settingsZanrovi', [\App\Http\Controllers\GenreController::class, 'prikaziSettingsZanrovi'])->name('settingsZanrovi');
    Route::post('/sacuvajZanr', [\App\Http\Controllers\GenreController::class, 'sacuvajZanr'])->name('sacuvajZanr');
    Route::post('/izmijeniZanr/{zanr}', [\App\Http\Controllers\GenreController::class, 'izmijeniZanr'])->name('izmijeniZanr');
    Route::get('/izbrisiZanr/{zanr}', [\App\Http\Controllers\GenreController::class, 'izbrisiZanr'])->name('izbrisiZanr');


    //POLICY - ROUTES
    Route::get('/settingsPolisa', [\App\Http\Controllers\PolicyController::class, 'prikaziSettingsPolisa'])->name('settingsPolisa');
});

require __DIR__.'/auth.php';
