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

    public function prikaziEditBibliotekar(User $bibliotekar) {
        return view('editBibliotekar', [
            'bibliotekar' => $bibliotekar
        ]);
    }

    public function prikaziNoviBibliotekar() {
        return view('noviBibliotekar');
    }

    public function izmijeniBibliotekara(User $bibliotekar) {
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

        //return back to the edit author form
        return view('bibliotekarProfile', [
            'bibliotekar' => $bibliotekar
        ]);
    }

    public function izbrisiBibliotekara(User $bibliotekar) {
        User::destroy($bibliotekar->id);

        return redirect('bibliotekari');
    }

    public function sacuvajBibliotekara(User $bibliotekar) {
        //request all data, validate and add librarian
        request()->validate([
            'imePrezimeBibliotekar' => 'required',
            'jmbgBibliotekar' => 'required',
            'emailBibliotekar' => 'required',
            'usernameBibliotekar' => 'required',
            'pwBibliotekar' => 'required',
            'pw2Bibliotekar' => 'required',
        ]);

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

        //return back to the librarian profile
        return view('bibliotekarProfile', [
            'bibliotekar' => $bibliotekar
        ]);
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
