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
    public function editBibliotekar($bibliotekar, $request) {
        //request all data, validate and update librarian
        request()->validate([
            'imePrezimeBibliotekarEdit' => 'sometimes|string|max:128',
            'jmbgBibliotekarEdit'       => 'sometimes|numeric|unique:users,jmbg|max:14',
            'emailBibliotekarEdit'      => 'sometimes|string|unique:users,email|max:128',
            'usernameBibliotekarEdit'   => 'sometimes|string|max:64',
            'pwBibliotekarEdit'         => 'sometimes|max:256',
            'pw2BibliotekarEdit'        => 'sometimes|max:256',
            'userImage'                 => 'image|nullable|string|max: 256'
        ]);

        $bibliotekar->name     = request('imePrezimeBibliotekarEdit');
        $bibliotekar->jmbg     = request('jmbgBibliotekarEdit');
        $bibliotekar->email    = request('emailBibliotekarEdit');
        $bibliotekar->username = request('usernameBibliotekarEdit');

        $this->uploadEditPhoto($bibliotekar, $request);

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
    public function saveBibliotekar($request) {
        //request all data, validate and add librarian
        request()->validate([
            'imePrezimeBibliotekar' => 'required|string|max:128',
            'jmbgBibliotekar'       => 'required|numeric|unique:users,jmbg|max:14',
            'emailBibliotekar'      => 'required|string|unique:users,email|max:128',
            'usernameBibliotekar'   => 'required|string|max:64',
            'pwBibliotekar'         => 'required|max:256',
            'pw2Bibliotekar'        => 'required|max:256',
            'userImage'             => 'image|nullable|string|max: 256'
        ]);

        $bibliotekar = new User(); 

        $bibliotekar->userType_id = 2;

        $bibliotekar->name              = request('imePrezimeBibliotekar');
        $bibliotekar->jmbg              = request('jmbgBibliotekar');
        $bibliotekar->email_verified_at = now();
        $bibliotekar->email             = request('emailBibliotekar');
        $bibliotekar->username          = request('usernameBibliotekar');
        $bibliotekar->remember_token    = Str::random(10);

        $this->uploadPhoto($bibliotekar, $request);

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
     * Vrati pretrazene bibliotekare
     *
     * @return void
     */
    public function searchBibliotekari() {

        $bibliotekari = User::query();
        
        $bibliotekari = $this->getBibliotekari();

        if(request('searchBibliotekari')) {
            $bibliotekarPretraga = request('searchBibliotekari');
            $bibliotekari = $bibliotekari->where('name', 'LIKE', '%'.$bibliotekarPretraga.'%');
        }

        $bibliotekari = $bibliotekari->paginate(7);

        return $bibliotekari;
    }

    /**
     * Uploaduj sliku ili postavi default sliku
     * 
     * @param User $user
     * @param Request $request
     * @return void
     */
    public function uploadPhoto($user, $request) {
        if ($request->hasFile('userImage')) {
            $this->uploadEditPhoto($user, $request);
        } else {
            $user->photo = 'default.jpg';
        }
    }

    /**
     * Upload/edit slike 
     * 
     * @param User $user
     * @param Request $request
     * @return void
     */
    public function uploadEditPhoto($user, $request) {
        if ($request->hasFile('userImage')) {
            $filenameWithExt = $request->file('userImage')->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file('userImage')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            // Upload Image
            $path = $request->file('userImage')->storeAs('public/image', $fileNameToStore);

            $user->photo = $fileNameToStore;
        }
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
    public function editUcenik($ucenik, $request) {
        //request all data, validate and update student
        request()->validate([
            'imePrezimeUcenikEdit'=> 'sometimes|string|max:128',
            'jmbgUcenikEdit'      => 'sometimes|numeric|unique:users,jmbg|max:14',
            'emailUcenikEdit'     => 'sometimes|string|unique:users,email|max:128',
            'usernameUcenikEdit'  => 'sometimes|string|max:64',
            'pwUcenikEdit'        => 'sometimes|max:256',
            'pw2UcenikEdit'       => 'sometimes|max:256',
            'userImage'           => 'image|nullable|string|max: 256'
        ]);

        $ucenik->name     = request('imePrezimeUcenikEdit');
        $ucenik->jmbg     = request('jmbgUcenikEdit');
        $ucenik->email    = request('emailUcenikEdit');
        $ucenik->username = request('usernameUcenikEdit');
      
        $this->uploadEditPhoto($ucenik, $request);

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
    public function saveUcenik($request) {
        //request all data, validate and update student
        request()->validate([
            'imePrezimeUcenik' => 'required|string|max:128',
            'jmbgUcenik'       => 'required|numeric|unique:users,jmbg|max:14',
            'emailUcenik'      => 'required|string|unique:users,email|max:128',
            'usernameUcenik'   => 'required|string|max:64',
            'pwUcenik'         => 'required|max:256',
            'pw2Ucenik'        => 'required|max:256',
            'userImage'        => 'image|nullable|string|max: 256'
        ]);

        $ucenik = new User(); 

        $ucenik->userType_id = 3;
    
        $ucenik->name              = request('imePrezimeUcenik');
        $ucenik->jmbg              = request('jmbgUcenik');
        $ucenik->email_verified_at = now();
        $ucenik->email             = request('emailUcenik');
        $ucenik->username          = request('usernameUcenik');
        $ucenik->remember_token    = Str::random(10);

        $this->uploadPhoto($ucenik, $request);

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
     * Vrati pretrazene ucenike
     *
     * @return void
     */
    public function searchUcenici() {

        $ucenici = User::query();
        
        $ucenici = $this->getUcenici();

        if(request('searchUcenici')) {
            $ucenikPretraga = request('searchUcenici');
            $ucenici = $ucenici->where('name', 'LIKE', '%'.$ucenikPretraga.'%');
        }

        $ucenici = $ucenici->paginate(7);

        return $ucenici;
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
            'pwReset'  => 'required',
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