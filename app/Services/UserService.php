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
            'imePrezimeBibliotekarEdit' => 'nullable|string|max:128|regex:/^([^0-9]*)$/',
            'jmbgBibliotekarEdit'       => 'nullable|digits:14|unique:users,jmbg',
            'emailBibliotekarEdit'      => 'nullable|string|unique:users,email|max:128',
            'usernameBibliotekarEdit'   => 'nullable|string|max:64',
            'pwBibliotekarEdit'         => 'nullable|max:256|min:8|same:pw2BibliotekarEdit',
            'pw2BibliotekarEdit'        => 'nullable|max:256|min:8|same:pwBibliotekarEdit',
            'userImage'                 => 'nullable|mimes:jpeg,png,jpg'
        ]);

        if(request('imePrezimeBibliotekarEdit')) {
            $bibliotekar->name     = request('imePrezimeBibliotekarEdit');
        }
        if(request('jmbgBibliotekarEdit')) {
            $bibliotekar->jmbg     = request('jmbgBibliotekarEdit');
        }
        if(request('emailBibliotekarEdit')) {
            $bibliotekar->email    = request('emailBibliotekarEdit');
        }
        if(request('usernameBibliotekarEdit')) {
            $bibliotekar->username = request('usernameBibliotekarEdit');
        }

        $this->uploadEditPhoto($bibliotekar, $request);

        if(request('pwBibliotekarEdit')) {
            $sifra1 = request('pwBibliotekarEdit');
            $bibliotekar->password=Hash::make($sifra1);
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
            'imePrezimeBibliotekar' => 'required|max:128|regex:/^([^0-9]*)$/',
            'jmbgBibliotekar'       => 'required|digits:14|unique:users,jmbg',
            'emailBibliotekar'      => 'required|string|unique:users,email|max:128',
            'usernameBibliotekar'   => 'required|string|max:64',
            'pwBibliotekar'         => 'required|max:256|min:8|same:pw2Bibliotekar',
            'pw2Bibliotekar'        => 'required|max:256|min:8|same:pwBibliotekar',
            'userImage'             => 'nullable|mimes:jpeg,png,jpg'
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

        $bibliotekar->password=Hash::make($sifra1);

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
            'imePrezimeUcenikEdit'=> 'nullable|string|max:128|regex:/^([^0-9]*)$/',
            'jmbgUcenikEdit'      => 'nullable|digits:14|unique:users,jmbg',
            'emailUcenikEdit'     => 'nullable|string|unique:users,email|max:128',
            'usernameUcenikEdit'  => 'nullable|string|max:64',
            'pwUcenikEdit'        => 'nullable|max:256|min:8|same:pw2UcenikEdit',
            'pw2UcenikEdit'       => 'nullable|max:256|min:8|same:pwUcenikEdit',
            'userImage'           => 'nullable|mimes:jpeg,png,jpg'
        ]);

        if(request('imePrezimeUcenikEdit')) {
            $ucenik->name = request('imePrezimeUcenikEdit');
        }
        if(request('jmbgUcenikEdit')) {
            $ucenik->jmbg = request('jmbgUcenikEdit');
        }
        if(request('emailUcenikEdit')) {
            $ucenik->email = request('emailUcenikEdit');
        }
        if(request('usernameUcenikEdit')) {
            $ucenik->username = request('usernameUcenikEdit');
        }

        $this->uploadEditPhoto($ucenik, $request);

        if(request('pwUcenikEdit')) {
            $sifra1 = request('pwUcenikEdit');
            $ucenik->password=Hash::make($sifra1);
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
            'imePrezimeUcenik' => 'required|string|max:128|regex:/^([^0-9]*)$/',
            'jmbgUcenik'       => 'required|digits:14|unique:users,jmbg',
            'emailUcenik'      => 'required|string|unique:users,email|max:128',
            'usernameUcenik'   => 'required|string|max:64',
            'pwUcenik'         => 'required|max:256|min:8|same:pw2Ucenik',
            'pw2Ucenik'        => 'required|max:256|min:8|same:pwUcenik',
            'userImage'        => 'nullable|mimes:jpeg,png,jpg'
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

        $ucenik->password=Hash::make($sifra1);

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
            'pwReset'  => 'required|min:8|max:256|same:pw2Reset',
            'pw2Reset' => 'required|min:8|max:256|same:pwReset',
        ]);

        $sifra1 = request('pwReset');
        $sifra2 = request('pw2Reset');

        $user->password=Hash::make($sifra1);

        $user->save();
    }

}
