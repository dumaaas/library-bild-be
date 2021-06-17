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
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'prikaziDashboard'])->name('dashboard');
    Route::get('/dashboardAktivnost', [\App\Http\Controllers\DashboardController::class, 'prikaziDashboardAktivnost'])->name('dashboardAktivnost');
    Route::get('/dashboardAktivnostKonkretneKnjige/{knjiga}', [\App\Http\Controllers\DashboardController::class, 'prikaziDashboardAktivnostKonkretneKnjige'])->name('dashboardAktivnostKonkretneKnjige');
    Route::post('/filterAktivnosti', [\App\Http\Controllers\DashboardController::class, 'filterAktivnosti'])->name('filterAktivnosti');

    //LIBRARIAN - ROUTES
    Route::get('/librarianProfile/{user}', [\App\Http\Controllers\UserController::class, 'showLibrarian'])->name('librarianProfile');
    Route::get('/librarians', [\App\Http\Controllers\UserController::class, 'showLibrarians']);
    Route::get('/editLibrarian/{user}', [\App\Http\Controllers\UserController::class, 'showEditLibrarian'])->name('editLibrarian');
    Route::post('/editLibrarian/{user}/update', [\App\Http\Controllers\UserController::class, 'updateLibrarian'])->name('updateLibrarian');
    Route::get('/deleteLibrarian/{user}', [\App\Http\Controllers\UserController::class, 'deleteLibrarian'])->name('deleteLibrarian');
    Route::get('/addLibrarian', [\App\Http\Controllers\UserController::class, 'showAddLibrarian'])->name('addLibrarian');
    Route::post('/saveLibrarian', [\App\Http\Controllers\UserController::class, 'saveLibrarian'])->name('saveLibrarian');
    Route::get('/searchLibrarians', [\App\Http\Controllers\UserController::class, 'searchLibrarians'])->name('searchLibrarians');
    Route::post('/resetPassword/{user}', [\App\Http\Controllers\UserController::class, 'resetPassword'])->name('resetPassword');

    //STUDENT - ROUTES
    Route::get('/ucenik', [\App\Http\Controllers\UserController::class, 'prikaziUcenike']);
    Route::get('/ucenikProfile/{user}', [\App\Http\Controllers\UserController::class, 'prikaziUcenikProfile'])->name('ucenikProfile');
    Route::get('/editUcenik/{user}', [\App\Http\Controllers\UserController::class, 'prikaziEditUcenik'])->name('editUcenik');
    Route::post('/editUcenik/{user}/update', [\App\Http\Controllers\UserController::class, 'izmjeniUcenika'])->name('updateUcenik');
    Route::get('/noviUcenik', [\App\Http\Controllers\UserController::class, 'prikaziNovogUcenika'])->name('noviUcenik');
    Route::get('/deleteUcenik/{user}', [\App\Http\Controllers\UserController::class, 'izbrisiUcenika'])->name('deleteUcenik');
    Route::post('/sacuvajUcenika', [\App\Http\Controllers\UserController::class, 'sacuvajUcenika'])->name('sacuvajUcenika');
    Route::get('/ucenikIzdate/{user}', [\App\Http\Controllers\UserController::class, 'prikaziUcenikIzdate'])->name('ucenikIzdate');
    Route::get('/ucenikVracene/{user}', [\App\Http\Controllers\UserController::class, 'prikaziUcenikVracene'])->name('ucenikVracene');
    Route::get('/ucenikPrekoracenje/{user}', [\App\Http\Controllers\UserController::class, 'prikaziUcenikPrekoracenje'])->name('ucenikPrekoracenje');
    Route::get('/ucenikAktivne/{user}', [\App\Http\Controllers\UserController::class, 'prikaziUcenikAktivne'])->name('ucenikAktivne');
    Route::get('/ucenikArhivirane/{user}', [\App\Http\Controllers\UserController::class, 'prikaziUcenikArhivirane'])->name('ucenikArhivirane');
    Route::get('/searchUcenici', [\App\Http\Controllers\UserController::class, 'searchUcenici'])->name('searchUcenici');


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
    Route::get('/vratiKnjige', [\App\Http\Controllers\BookController::class, 'vratiKnjige'])->name('vratiKnjige');
    Route::get('/otpisiKnjigu/{knjiga}', [\App\Http\Controllers\BookController::class, 'prikaziOtpisiKnjigu'])->name('otpisiKnjigu');
    Route::get('/otpisiKnjige', [\App\Http\Controllers\BookController::class, 'otpisiKnjige'])->name('otpisiKnjige');;
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
    Route::get('/filterAutori', [\App\Http\Controllers\BookController::class, 'filterAutori'])->name('filterAutori');
    Route::get('/searchKnjige', [\App\Http\Controllers\BookController::class, 'searchKnjige'])->name('searchKnjige');
    Route::get('/searchVrati/{knjiga}', [\App\Http\Controllers\BookController::class, 'searchVrati'])->name('searchVrati');
    Route::get('/searchOtpisi/{knjiga}', [\App\Http\Controllers\BookController::class, 'searchOtpisi'])->name('searchOtpisi');

    //RESERVATION - ROUTES

    //RENT - ROUTES
    Route::get('/izdavanjeDetalji/{knjiga}/{ucenik}', [\App\Http\Controllers\RentController::class, 'prikaziIzdavanjeDetalji'])->name('izdavanjeDetalji');
    Route::get('/knjigePrekoracenje', [\App\Http\Controllers\RentController::class, 'prikaziKnjigePrekoracenje'])->name('knjigePrekoracenje');
    Route::get('/izdateKnjige', [\App\Http\Controllers\RentController::class, 'prikaziIzdateKnjige'])->name('izdateKnjige');
    Route::get('/vraceneKnjige', [\App\Http\Controllers\RentController::class, 'prikaziVraceneKnjige'])->name('vraceneKnjige');
    Route::get('/aktivneRezervacije', [\App\Http\Controllers\RentController::class, 'prikaziAktivneRezervacije'])->name('aktivneRezervacije');
    Route::get('/arhiviraneRezervacije', [\App\Http\Controllers\RentController::class, 'prikaziArhiviraneRezervacije'])->name('arhiviraneRezervacije');
    Route::get('/izbrisiTransakciju/{knjiga}/{ucenik}', [\App\Http\Controllers\RentController::class, 'izbrisiTransakciju'])->name('izbrisiTransakciju');
    Route::get('/filterIzdateKnjige', [\App\Http\Controllers\RentController::class, 'filterIzdateKnjige'])->name('filterIzdateKnjige');
    Route::get('/filterVraceneKnjige', [\App\Http\Controllers\RentController::class, 'filterVraceneKnjige'])->name('filterVraceneKnjige');
    Route::get('/filterPrekoraceneKnjige', [\App\Http\Controllers\RentController::class, 'filterPrekoraceneKnjige'])->name('filterPrekoraceneKnjige');
    Route::get('/searchIzdateKnjige', [\App\Http\Controllers\RentController::class, 'searchIzdateKnjige'])->name('searchIzdateKnjige');
    Route::get('/searchVraceneKnjige', [\App\Http\Controllers\RentController::class, 'searchVraceneKnjige'])->name('searchVraceneKnjige');
    Route::get('/searchPrekoraceneKnjige', [\App\Http\Controllers\RentController::class, 'searchPrekoraceneKnjige'])->name('searchPrekoraceneKnjige');
    Route::get('/searchAktivneRezervacije', [\App\Http\Controllers\RentController::class, 'searchAktivneRezervacije'])->name('searchAktivneRezervacije');
    Route::get('/searchArhiviraneRezervacije', [\App\Http\Controllers\RentController::class, 'searchArhiviraneRezervacije'])->name('searchArhiviraneRezervacije');

    //SCRIPT - ROUTES
    Route::get('/editPismo/{pismo}', [\App\Http\Controllers\ScriptController::class, 'prikaziEditPismo'])->name('editPismo');
    Route::get('/novoPismo', [\App\Http\Controllers\ScriptController::class, 'prikaziNovoPismo'])->name('novoPismo');
    Route::get('/settingsPismo', [\App\Http\Controllers\ScriptController::class, 'prikaziSettingsPismo'])->name('settingsPismo');
    Route::post('/sacuvajPismo', [\App\Http\Controllers\ScriptController::class, 'sacuvajPismo'])->name('sacuvajPismo');
    Route::post('/izmijeniPismo/{pismo}', [\App\Http\Controllers\ScriptController::class, 'izmijeniPismo'])->name('izmijeniPismo');
    Route::get('/izbrisiPismo/{pismo}', [\App\Http\Controllers\ScriptController::class, 'izbrisiPismo'])->name('izbrisiPismo');


    //FORMAT - ROUTES
    Route::get('/editFormat/{format}', [\App\Http\Controllers\FormatController::class, 'showEditFormat'])->name('editFormat');
    Route::get('/addFormat', [\App\Http\Controllers\FormatController::class, 'showAddFormat'])->name('addFormat');
    Route::get('/formats', [\App\Http\Controllers\FormatController::class, 'showFormats'])->name('formats');
    Route::post('/saveFormat', [\App\Http\Controllers\FormatController::class, 'saveFormat'])->name('saveFormat');
    Route::post('/updateFormat/{format}', [\App\Http\Controllers\FormatController::class, 'updateFormat'])->name('updateFormat');
    Route::get('/deleteFormat/{format}', [\App\Http\Controllers\FormatController::class, 'deleteFormat'])->name('deleteFormat');


    //LANGUAGE - ROUTES


    //BINDING - ROUTES
    Route::get('/editBinding/{binding}', [\App\Http\Controllers\BindingController::class, 'showEditBinding'])->name('editBinding');
    Route::get('/addBinding', [\App\Http\Controllers\BindingController::class, 'showAddBinding'])->name('addBinding');
    Route::get('/bindings', [\App\Http\Controllers\BindingController::class, 'showBindings'])->name('bindings');
    Route::post('/saveBinding', [\App\Http\Controllers\BindingController::class, 'saveBinding'])->name('saveBinding');
    Route::post('/updateBinding/{binding}', [\App\Http\Controllers\BindingController::class, 'updateBinding'])->name('updateBinding');
    Route::get('/deleteBinding/{binding}', [\App\Http\Controllers\BindingController::class, 'deleteBinding'])->name('deleteBinding');


    //PUBLISHER - ROUTES
    Route::get('/editIzdavac/{izdavac}', [\App\Http\Controllers\PublisherController::class, 'prikaziEditIzdavac'])->name('editIzdavac');
    Route::get('/noviIzdavac', [\App\Http\Controllers\PublisherController::class, 'prikaziNoviIzdavac'])->name('prikaziNoviIzdavac');
    Route::get('/settingsIzdavac', [\App\Http\Controllers\PublisherController::class, 'prikaziSettingsIzdavac'])->name('settingsIzdavac');
    Route::post('/izmijeniIzdavaca/{izdavac}', [\App\Http\Controllers\PublisherController::class, 'izmijeniIzdavaca'])->name('izmijeniIzdavaca');
    Route::get('/izbrisiIzdavaca/{izdavac}', [\App\Http\Controllers\PublisherController::class, 'izbrisiIzdavaca'])->name('izbrisiIzdavaca');
    Route::post('/sacuvajIzdavaca}', [\App\Http\Controllers\PublisherController::class, 'sacuvajIzdavaca'])->name('sacuvajIzdavaca');


    //CATEGORY - ROUTES
    Route::get('/editCategory/{category}', [\App\Http\Controllers\CategoryController::class, 'showEditCategory'])->name('editCategory');
    Route::get('/addCategory', [\App\Http\Controllers\CategoryController::class, 'showAddCategory'])->name('addCategory');
    Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'showCategories'])->name('categories');
    Route::post('/saveCategory', [\App\Http\Controllers\CategoryController::class, 'saveCategory'])->name('saveCategory');
    Route::post('/updateCategory/{category}', [\App\Http\Controllers\CategoryController::class, 'updateCategory'])->name('updateCategory');
    Route::get('/deleteCategory/{category}', [\App\Http\Controllers\CategoryController::class, 'deleteCategory'])->name('deleteCategory');


    //AUTHOR - ROUTES
    Route::get('/autorProfile/{autor}', [\App\Http\Controllers\AuthorController::class, 'prikaziAutora'])->name('autorProfile');
    Route::get('/autori', [\App\Http\Controllers\AuthorController::class, 'prikaziAutore']);
    Route::get('/editAutor/{autor}', [\App\Http\Controllers\AuthorController::class, 'prikaziEditAutor'])->name('editAutor');
    Route::post('/editAutor/{autor}/update', [\App\Http\Controllers\AuthorController::class, 'izmijeniAutora'])->name('updateAutor');
    Route::get('/noviAutor', [\App\Http\Controllers\AuthorController::class, 'prikaziNoviAutor'])->name('noviAutor');
    Route::get('/deleteAutor/{autor}', [\App\Http\Controllers\AuthorController::class, 'izbrisiAutora'])->name('deleteAutor');
    Route::post('/sacuvajAutora', [\App\Http\Controllers\AuthorController::class, 'sacuvajAutora'])->name('sacuvajAutora');
    Route::get('/searchAutori', [\App\Http\Controllers\AuthorController::class, 'searchAutori'])->name('searchAutori');


    //GALLERY - ROUTES
    Route::get('/deleteImage/{slika}', [\App\Http\Controllers\GaleryController::class, 'deleteImage'])->name('deleteImage');


    //GENRE - ROUTES
    Route::get('/editZanr{zanr}', [\App\Http\Controllers\GenreController::class, 'prikaziEditZanr'])->name('editZanr');
    Route::get('/noviZanr', [\App\Http\Controllers\GenreController::class, 'prikaziNoviZanr'])->name('noviZanr');
    Route::get('/settingsZanrovi', [\App\Http\Controllers\GenreController::class, 'prikaziSettingsZanrovi'])->name('settingsZanrovi');
    Route::post('/sacuvajZanr', [\App\Http\Controllers\GenreController::class, 'sacuvajZanr'])->name('sacuvajZanr');
    Route::post('/izmijeniZanr/{zanr}', [\App\Http\Controllers\GenreController::class, 'izmijeniZanr'])->name('izmijeniZanr');
    Route::get('/izbrisiZanr/{zanr}', [\App\Http\Controllers\GenreController::class, 'izbrisiZanr'])->name('izbrisiZanr');


    //POLICY - ROUTES
    Route::get('/settingsPolisa', [\App\Http\Controllers\PolicyController::class, 'prikaziSettingsPolisa'])->name('settingsPolisa');
    Route::post('/izmijeniRok', [\App\Http\Controllers\PolicyController::class, 'izmijeniRok'])->name('izmijeniRok');

});

require __DIR__.'/auth.php';
