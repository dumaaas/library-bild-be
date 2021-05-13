<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use DB;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function prikaziEditIzdavac(Publisher $izdavac) {
        return view('editIzdavac', [
            'izdavac' => $izdavac
        ]);
    }

    public function prikaziNoviIzdavac() {
        return view('noviIzdavac');
    }

    public function prikaziSettingsIzdavac() {
        return view('settingsIzdavac', [
            'izdavaci' => DB::table('publishers')->paginate(7)
        ]);
    }

    public function izmijeniIzdavaca(Publisher $izdavac) {
        //request all data, validate and update publisher
        request()->validate([
            'nazivIzdavacEdit'=>'required',
        ]);

        $izdavac->name=request('nazivIzdavacEdit');

        $izdavac->save();

        //return back to the publisher
        return view('editIzdavac', [
            'izdavac' => $izdavac
        ]);
    }

    public function izbrisiIzdavaca(Publisher $izdavac) {
        Publisher::destroy($izdavac->id);
        return back();
    }

    public function sacuvajIzdavaca(Publisher $izdavac) {
        //request all data, validate and update publisher
        request()->validate([
            'nazivIzdavac'=>'required',
        ]);

        $izdavac = new Publisher();

        $izdavac->name=request('nazivIzdavac');

        $izdavac->save();

        //return back to the publisher
        return view('editIzdavac', [
            'izdavac' => $izdavac
        ]);
    }
}
