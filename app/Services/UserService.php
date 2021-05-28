<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| UserService
|--------------------------------------------------------------------------
|
| UserService je odgovaran za svu logiku koja se desava 
| unutar UserControllera. Ovdje je moguce definisati sve 
| pomocne metode koji su potrebne.
|
*/

class UserService {

    /**
     * Vrati sve bibliotekare iz baze podataka
     *
     * @return void
     */
    public function getBibliotekari() {
        return $bibliotekari = User::with('userType')
                            ->where('userType_id', '=', 2);
    }

    /**
     * Izvrsi validaciju podataka i edituj bibliotekara
     *
     * @param  User  $bibliotekar
     * @return void
     */
    public function editBibliotekar($bibliotekar) {
        //request all data, validate and update librarian
        request()->validate([
            'imePrezimeBibliotekarEdit' => 'required',
            'jmbgBibliotekarEdit' => 'required',
            'emailBibliotekarEdit' => 'required',
            'usernameBibliotekarEdit' => 'required',
            'pwBibliotekarEdit' => 'required',
            'pw2BibliotekarEdit' => 'required',
        ]);

        $bibliotekar->name=request('imePrezimeBibliotekarEdit');
        $bibliotekar->jmbg=request('jmbgBibliotekarEdit');
        $bibliotekar->email=request('emailBibliotekarEdit');
        $bibliotekar->username=request('usernameBibliotekarEdit');

        $sifra1 = request('pwBibliotekarEdit');
        $sifra2 = request('pw2BibliotekarEdit');

        if($sifra1 == $sifra2){
            $bibliotekar->password=Hash::make($sifra1);  
        }else{
            //Promijeniti ovo
            echo('Moraju se poklapati sifre');
        }
             
        $bibliotekar->save();
    }

    /**
     * Kreiraj novog bibliotekara i sacuvaj ga u bazu
     *
     * @return void
     */
    public function saveBibliotekar() {
        //request all data, validate and add librarian
        request()->validate([
            'imePrezimeBibliotekar' => 'required',
            'jmbgBibliotekar' => 'required',
            'emailBibliotekar' => 'required',
            'usernameBibliotekar' => 'required',
            'pwBibliotekar' => 'required',
            'pw2Bibliotekar' => 'required',
        ]);

        $bibliotekar = new User(); 

        $userTypeId = DB::table('user_types')->select('id')->where('name', '=', 'librarian')->value('id');
        $bibliotekar->userType_id = $userTypeId;

        $bibliotekar->name=request('imePrezimeBibliotekar');
        $bibliotekar->jmbg=request('jmbgBibliotekar');
        $bibliotekar->email_verified_at = now();
        $bibliotekar->email=request('emailBibliotekar');
        $bibliotekar->username=request('usernameBibliotekar');
        $bibliotekar->remember_token = Str::random(10);

        $sifra1 = request('pwBibliotekar');
        $sifra2 = request('pw2Bibliotekar');

        if($sifra1 == $sifra2){
            $bibliotekar->password=Hash::make($sifra1);  
        }else{
            //Promijeniti ovo
            echo('Moraju se poklapati sifre');
        }
             
        $bibliotekar->save();

        return $bibliotekar;
    }

    /**
     * Vrati sve ucenike iz baze podataka
     *
     * @return void
     */
    public function getUcenici() {
        return $ucenici = User::with('userType')
                        ->where('userType_id', '=', 3);
    }

    /**
     * Izvrsi validaciju podataka i edituj ucenika
     *
     * @param  User  $ucenik
     * @return void
     */
    public function editUcenik($ucenik) {
        //request all data, validate and update student
        request()->validate([
            'imePrezimeUcenikEdit'=>'required',
            'jmbgUcenikEdit' => 'required',
            'emailUcenikEdit' => 'required',
            'usernameUcenikEdit' => 'required',
            'pwUcenikEdit' => 'required',
            'pw2UcenikEdit' => 'required',
        ]);
        $ucenik->name=request('imePrezimeUcenikEdit');
        $ucenik->jmbg=request('jmbgUcenikEdit');
        $ucenik->email=request('emailUcenikEdit');
        $ucenik->username=request('usernameUcenikEdit');
      
        $sifra1 = request('pwUcenikEdit');
        $sifra2 = request('pw2UcenikEdit');

        if($sifra1 == $sifra2){
            $ucenik->password=Hash::make($sifra1);  
        }else{
            //Promijeniti ovo
            echo('Moraju se poklapati sifre');
        }
             
        $ucenik->save();
    }

    /**
     * Kreiraj novog ucenika i sacuvaj ga u bazu
     *
     * @return void
     */
    public function saveUcenik() {
        //request all data, validate and update student
        request()->validate([
            'imePrezimeUcenik'=>'required',
            'jmbgUcenik' => 'required',
            'emailUcenik' => 'required',
            'usernameUcenik' => 'required',
            'pwUcenik' => 'required',
            'pw2Ucenik' => 'required',
        ]);

        $ucenik = new User(); 

        $userTypeId=DB::table('user_types')->select('id')->where('name', '=', 'student')->value('id');
        $ucenik->userType_id =$userTypeId;
    
        $ucenik->name=request('imePrezimeUcenik');
        $ucenik->jmbg=request('jmbgUcenik');
        $ucenik->email_verified_at = now();
        $ucenik->email=request('emailUcenik');
        $ucenik->username=request('usernameUcenik');
        $ucenik->remember_token = Str::random(10);

        $sifra1 = request('pwUcenik');
        $sifra2 = request('pw2Ucenik');

        if($sifra1 == $sifra2){
            $ucenik->password=Hash::make($sifra1);  
        }else{
            //Promijeniti ovo
            echo('Moraju se poklapati sifre');
        }

        $ucenik->save();

        return $ucenik;
    }

    /**
     * Resetuj sifru korisnika
     *
     * @param  User  $ucenik
     * @return void
     */
    public function resetujSifru($user) {
        //request all data, validate and update student
        request()->validate([
            'pwReset'=>'required',
            'pw2Reset' => 'required',
        ]);

        $sifra1 = request('pwReset');
        $sifra2 = request('pw2Reset');

        if($sifra1 == $sifra2){
            $user->password=Hash::make($sifra1);  
        }else{
            //Promijeniti ovo
            echo('Moraju se poklapati sifre');
        }

        $user->save();
    }

}