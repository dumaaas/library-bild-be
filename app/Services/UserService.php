<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService {

    public function getBibliotekari() {
        return $bibliotekari = User::with('userType')
                            ->where('userType_id', '=', 2);
    }

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

    public function getUcenici() {
        return $ucenici = User::with('userType')
                        ->where('userType_id', '=', 3);
    }

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
}