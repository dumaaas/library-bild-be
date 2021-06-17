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
    public function getLibrarians() {
        return $librarians = User::with('userType')
                            ->where('userType_id', '=', 2);
    }

    /**
     * Izvrsi validaciju podataka i edituj bibliotekara
     *
     * @param  User  $bibliotekar
     * @return void
     */
    public function editLibrarian($librarian, $request) {
        //request all data, validate and update librarian
        request()->validate([
            'librarianNameEdit'       => 'nullable|string|max:128|regex:/^([^0-9]*)$/',
            'librarianJmbgEdit'       => 'nullable|digits:14|unique:users,jmbg',
            'librarianEmailEdit'      => 'nullable|string|unique:users,email|max:128',
            'librarianUsernameEdit'   => 'nullable|string|max:64',
            'librarianPasswordEdit'   => 'nullable|max:256|min:8|same:librarianPassword2Edit',
            'librarianPassword2Edit'  => 'nullable|max:256|min:8|same:librarianPasswordEdit',
            'userImage'               => 'nullable|mimes:jpeg,png,jpg'
        ]);

        if(request('librarianNameEdit')) {
            $librarian->name     = request('librarianNameEdit');
        }
        if(request('librarianJmbgEdit')) {
            $librarian->jmbg     = request('librarianJmbgEdit');
        }
        if(request('librarianEmailEdit')) {
            $librarian->email    = request('librarianEmailEdit');
        }
        if(request('librarianUsernameEdit')) {
            $librarian->username = request('librarianUsernameEdit');
        }

        $this->uploadEditPhoto($librarian, $request);

        if(request('librarianPasswordEdit')) {
            $password = request('librarianPasswordEdit');
            $librarian->password=Hash::make($password);
        }

        $librarian->save();
    }

    /**
     * Kreiraj novog bibliotekara i sacuvaj ga u bazu
     *
     * @return void
     */
    public function saveLibrarian($request) {
        //request all data, validate and add librarian
        request()->validate([
            'librarianName'       => 'required|max:128|regex:/^([^0-9]*)$/',
            'librarianJmbg'       => 'required|digits:14|unique:users,jmbg',
            'librarianEmail'      => 'required|string|unique:users,email|max:128',
            'librarianUsername'   => 'required|string|max:64',
            'librarianPassword'   => 'required|max:256|min:8|same:librarianPassword2',
            'librarianPassword2'  => 'required|max:256|min:8|same:librarianPassword',
            'userImage'           => 'nullable|mimes:jpeg,png,jpg'
        ]);

        $librarian = new User();

        $librarian->userType_id = 2;

        $librarian->name              = request('librarianName');
        $librarian->jmbg              = request('librarianJmbg');
        $librarian->email_verified_at = now();
        $librarian->email             = request('librarianEmail');
        $librarian->username          = request('librarianUsername');
        $librarian->remember_token    = Str::random(10);

        $this->uploadPhoto($librarian, $request);

        $password = request('librarianPassword');
        $passwordRepeat = request('librarianPassword2');

        $librarian->password=Hash::make($password);

        $librarian->save();

        return $librarian;
    }

    /**
     * Vrati pretrazene bibliotekare
     *
     * @return void
     */
    public function searchLibrarians() {

        $librarians = User::query();

        $librarians = $this->getLibrarians();

        if(request('searchLibrarians')) {
            $searchedLibrarians = request('searchLibrarians');
            $librarians = $librarians->where('name', 'LIKE', '%'.$searchedLibrarians.'%');
        }

        $librarians = $librarians->paginate(7);

        return $librarians;
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
     * @param  User  $user
     * @return void
     */
    public function resetPassword($user) {
        //request all data, validate and reset password
        request()->validate([
            'pwReset'  => 'required|min:8|max:256|same:pw2Reset',
            'pw2Reset' => 'required|min:8|max:256|same:pwReset',
        ]);

        $password = request('pwReset');
        $passwordRepeat = request('pw2Reset');

        $user->password=Hash::make($password);

        $user->save();
    }

}
