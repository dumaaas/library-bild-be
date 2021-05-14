<?php

namespace App\Http\Controllers;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function prikaziBibliotekara(User $bibliotekar) {
        return view('bibliotekarProfile', [
            'bibliotekar' => $bibliotekar
        ]);
    }

    public function prikaziBibliotekare() {
        return view('bibliotekari', [
            'bibliotekari' => User::with('userType')->where('userType_id', '=', 2)->paginate(7)
        ]);
    }

    public function prikaziEditBibliotekar() {
        return view('editBibliotekar');
    }

    public function prikaziNoviBibliotekar() {
        return view('noviBibliotekar');
    }

    public function prikaziUcenike() {
        return view('ucenik', [
            'ucenici' => User::with('userType')->where('userType_id', '=', 3)->paginate(7)
        ]);
    }
    public function prikaziUcenikProfile(User $ucenik) {
        return view('ucenikProfile', [
            'ucenik' => $ucenik
        ]);
    }
    public function prikaziNovogUcenika() {
        return view('noviUcenik');
    }
    public function prikaziEditUcenik(User $ucenik) {
        return view('editUcenik', [
            'ucenik' => $ucenik
        ]);
    }
    public function izmjeniUcenika(User $ucenik) {
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

        //return back to the edit student form
        return view('ucenikProfile', [
            'ucenik' => $ucenik
        ]);
    }
    public function izbrisiUcenika(User $ucenik) {
        User::destroy($ucenik->id);

        return redirect('ucenik');
    }
    public function sacuvajUcenika(User $ucenik) {
        //request all data, validate and update student
        request()->validate([
            'imePrezimeUcenik'=>'required',
            'jmbgUcenik' => 'required',
            'emailUcenik' => 'required',
            'usernameUcenik' => 'required',
            'pwUcenik' => 'required',
            'pw2Ucenik' => 'required',
        ]);
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

        //return back to the edit student form
        return view('ucenikProfile', [
            'ucenik' => $ucenik
        ]);
    }

    public function prikaziUcenikIzdate() {
        return view('ucenikIzdate');
    }

    public function prikaziUcenikVracene() {
        return view('ucenikVracene');
    }

    public function prikaziUcenikPrekoracenje() {
        return view('ucenikPrekoracenje');
    }

    public function prikaziUcenikAktivne() {
        return view('ucenikAktivne');
    }

    public function prikaziUcenikArhivirane() {
        return view('ucenikArhivirane');
    }
}
