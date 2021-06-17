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

    //USER - ROUTES
    Route::get('/bibliotekarProfile/{user}', [\App\Http\Controllers\UserController::class, 'prikaziBibliotekara'])->name('bibliotekarProfile');
    Route::get('/bibliotekari', [\App\Http\Controllers\UserController::class, 'prikaziBibliotekare']);
    Route::get('/editBibliotekar/{user}', [\App\Http\Controllers\UserController::class, 'prikaziEditBibliotekar'])->name('editBibliotekar');
    Route::post('/editBibliotekar/{user}/update', [\App\Http\Controllers\UserController::class, 'izmijeniBibliotekara'])->name('updateBibliotekar');
    Route::get('/deleteBibliotekar/{user}', [\App\Http\Controllers\UserController::class, 'izbrisiBibliotekara'])->name('deleteBibliotekar');
    Route::get('/noviBibliotekar', [\App\Http\Controllers\UserController::class, 'prikaziNoviBibliotekar'])->name('noviBibliotekar');
    Route::post('/sacuvajBibliotekara', [\App\Http\Controllers\UserController::class, 'sacuvajBibliotekara'])->name('sacuvajBibliotekara');
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
    Route::post('/resetujSifru/{user}', [\App\Http\Controllers\UserController::class, 'resetujSifru'])->name('resetujSifru');
    Route::get('/searchBibliotekari', [\App\Http\Controllers\UserController::class, 'searchBibliotekari'])->name('searchBibliotekari');
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
    Route::get('/editScript/{script}', [\App\Http\Controllers\ScriptController::class, 'showEditScript'])->name('editScript');
    Route::get('/addScript', [\App\Http\Controllers\ScriptController::class, 'showAddScript'])->name('addScript');
    Route::get('/scripts', [\App\Http\Controllers\ScriptController::class, 'showScripts'])->name('scripts');
    Route::post('/saveScript', [\App\Http\Controllers\ScriptController::class, 'saveScript'])->name('saveScript');
    Route::post('/updateScript/{script}', [\App\Http\Controllers\ScriptController::class, 'updateScript'])->name('updateScript');
    Route::get('/deleteScript/{script}', [\App\Http\Controllers\ScriptController::class, 'deleteScript'])->name('deleteScript');


    //FORMAT - ROUTES
    Route::get('/editFormat/{format}', [\App\Http\Controllers\FormatController::class, 'prikaziEditFormat'])->name('editFormat');
    Route::get('/noviFormat', [\App\Http\Controllers\FormatController::class, 'prikaziNoviFormat'])->name('noviFormat');
    Route::get('/settingsFormat', [\App\Http\Controllers\FormatController::class, 'prikaziSettingsFormat'])->name('settingsFormat');
    Route::post('/sacuvajFormat', [\App\Http\Controllers\FormatController::class, 'sacuvajFormat'])->name('sacuvajFormat');
    Route::post('/izmijeniFormat/{format}', [\App\Http\Controllers\FormatController::class, 'izmijeniFormat'])->name('izmijeniFormat');
    Route::get('/izbrisiFormat/{format}', [\App\Http\Controllers\FormatController::class, 'izbrisiFormat'])->name('izbrisiFormat');


    //LANGUAGE - ROUTES


    //BINDING - ROUTES
    Route::get('/editBinding/{binding}', [\App\Http\Controllers\BindingController::class, 'showEditBinding'])->name('editBinding');
    Route::get('/addBinding', [\App\Http\Controllers\BindingController::class, 'showAddBinding'])->name('addBinding');
    Route::get('/bindings', [\App\Http\Controllers\BindingController::class, 'showBindings'])->name('bindings');
    Route::post('/saveBinding', [\App\Http\Controllers\BindingController::class, 'saveBinding'])->name('saveBinding');
    Route::post('/updateBinding/{binding}', [\App\Http\Controllers\BindingController::class, 'updateBinding'])->name('updateBinding');
    Route::get('/deleteBinding/{binding}', [\App\Http\Controllers\BindingController::class, 'deleteBinding'])->name('deleteBinding');


    //PUBLISHER - ROUTES
    Route::get('/editPublisher/{publisher}', [\App\Http\Controllers\PublisherController::class, 'showEditPublisher'])->name('editPublisher');
    Route::get('/addPublisher', [\App\Http\Controllers\PublisherController::class, 'showAddPublisher'])->name('addPublisher');
    Route::get('/publishers', [\App\Http\Controllers\PublisherController::class, 'showPublishers'])->name('publishers');
    Route::post('/updatePublisher/{publisher}', [\App\Http\Controllers\PublisherController::class, 'updatePublisher'])->name('updatePublisher');
    Route::get('/deletePublisher/{publisher}', [\App\Http\Controllers\PublisherController::class, 'deletePublisher'])->name('deletePublisher');
    Route::post('/savePublisher}', [\App\Http\Controllers\PublisherController::class, 'savePublisher'])->name('savePublisher');


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
    Route::get('/searchAutori', [\App\Http\Controllers\AuthorController::class, 'searchAutori'])->name('searchAutori');


    //GALLERY - ROUTES
    Route::get('/deleteImage/{slika}', [\App\Http\Controllers\GaleryController::class, 'deleteImage'])->name('deleteImage');


    //GENRE - ROUTES
    Route::get('/editGenre{genre}', [\App\Http\Controllers\GenreController::class, 'showEditGenre'])->name('editGenre');
    Route::get('/addGenre', [\App\Http\Controllers\GenreController::class, 'showAddGenre'])->name('addGenre');
    Route::get('/genres', [\App\Http\Controllers\GenreController::class, 'showGenres'])->name('genres');
    Route::post('/saveGenre', [\App\Http\Controllers\GenreController::class, 'saveGenre'])->name('saveGenre');
    Route::post('/updateGenre/{genre}', [\App\Http\Controllers\GenreController::class, 'updateGenre'])->name('updateGenre');
    Route::get('/deleteGenre/{genre}', [\App\Http\Controllers\GenreController::class, 'deleteGenre'])->name('deleteGenre');


    //POLICY - ROUTES
    Route::get('/policy', [\App\Http\Controllers\PolicyController::class, 'showPolicy'])->name('policy');
    Route::post('/changeDeadline', [\App\Http\Controllers\PolicyController::class, 'changeDeadline'])->name('changeDeadline');

});

require __DIR__.'/auth.php';
