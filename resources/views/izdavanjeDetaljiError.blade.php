@extends('layouts.layout')

@section('izdavanjeDetaljiError')
    <div class="pl-[110px] section- mt-[35px]">
        <span class="bg-red-200 text-red-800 py-2 px-2 rounded ">Ne postoje informacije o izdavanju za knjigu {{$knjiga->title}}!</span>
    </div>

@endsection
