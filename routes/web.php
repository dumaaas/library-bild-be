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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


//USER - ROUTES


//BOOK - ROUTES

//RESERVATION - ROUTES
Route::get('/aktivneRezervacije', [\App\Http\Controllers\ReservationController::class, 'prikaziAktivneRezervacije']);

//RENT - ROUTES


//SCRIPT - ROUTES


//FORMAT - ROUTES


//LANGUAGE - ROUTES


//BINDING - ROUTES


//PUBLISHER - ROUTES


//CATEGORY - ROUTES


//AUTHOR - ROUTES


//GALLERY - ROUTES


//GENRE - ROUTES













require __DIR__.'/auth.php';
