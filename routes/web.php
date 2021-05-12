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


//BOOK - ROUTES
Route::get('/editKnjiga', [\App\Http\Controllers\BookController::class, 'prikaziEditKnjiga']);
Route::get('/editKnjigaMultimedija', [\App\Http\Controllers\BookController::class, 'prikaziEditKnjigaMultimedija']);
Route::get('/editKnjigaSpecifikacija', [\App\Http\Controllers\BookController::class, 'prikaziEditKnjigaSpecifikacija']);
Route::get('/evidencijaKnjiga', [\App\Http\Controllers\BookController::class, 'prikaziEvidencijaKnjiga']);
Route::get('/evidencijaKnjigaMultimedija', [\App\Http\Controllers\BookController::class, 'prikaziEvidencijaKnjigaMultimedija']);


//RESERVATION - ROUTES
Route::get('/aktivneRezervacije', [\App\Http\Controllers\ReservationController::class, 'prikaziAktivneRezervacije']);
Route::get('/arhiviraneRezervacije', [\App\Http\Controllers\ReservationController::class, 'prikaziArhiviraneRezervacije']);

//RENT - ROUTES


//SCRIPT - ROUTES
Route::get('/editPismo', [\App\Http\Controllers\ScriptController::class, 'prikaziEditPismo']);


//FORMAT - ROUTES
Route::get('/editFormat', [\App\Http\Controllers\FormatController::class, 'prikaziEditFormat']);


//LANGUAGE - ROUTES


//BINDING - ROUTES
Route::get('/editPovez', [\App\Http\Controllers\BindingController::class, 'prikaziEditPovez']);


//PUBLISHER - ROUTES
Route::get('/editIzdavac', [\App\Http\Controllers\PublisherController::class, 'prikaziEditIzdavac']);


//CATEGORY - ROUTES
Route::get('/editKategorija', [\App\Http\Controllers\CategoryController::class, 'prikaziEditKategorija']);


//AUTHOR - ROUTES
Route::get('/autorProfile', [\App\Http\Controllers\AuthorController::class, 'prikaziAutora']);
Route::get('/autori', [\App\Http\Controllers\AuthorController::class, 'prikaziAutore']);
Route::get('/editAutor', [\App\Http\Controllers\AuthorController::class, 'prikaziEditAutor']);


//GALLERY - ROUTES


//GENRE - ROUTES
Route::get('/editZanr', [\App\Http\Controllers\GenreController::class, 'prikaziEditZanr']);



require __DIR__.'/auth.php';
