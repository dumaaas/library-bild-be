@extends('layouts.knjiga')

@section('knjigeMultimedija')
    <div class="w-[80%]">
        <div class="border-b-[1px] border-[#e4dfdf] py-4 text-gray-500 pl-[30px]">
            <a href="{{route('knjigaOsnovniDetalji', ['knjiga' => $knjiga])}}" class="inline hover:text-blue-800">
                Osnovni detalji
            </a>
            <a href="{{route('knjigaSpecifikacija', ['knjiga' => $knjiga])}}" class="inline ml-[70px]  hover:text-blue-800">
                Specifikacija
            </a>
            <a href="{{route('iznajmljivanjeIzdate', ['knjiga' => $knjiga])}}" class="inline ml-[70px] hover:text-blue-800">
                Evidencija iznajmljivanja
            </a>
            <a href="{{route('evidencijaKnjigaMultimedija', ['knjiga' => $knjiga])}}" class="inline ml-[70px] active-book-nav hover:text-blue-800">
                Multimedija
            </a>
        </div>
        <div class="">
            <!-- Space for content -->
            @if(count($knjiga->galery) > 0)
            <div class="mt-[20px] mx-0 w-[100%]">
                <div class="flex flex-row">
                    <div class="w-[100%]">
                        <div class="w-[90%] flex flex-row flex-wrap mx-auto bg-white rounded p7 mt-[20px]">
                            @foreach($knjiga->galery as $slika) 
                            <div class="p-[15px] w-[430px] h-[300px]">
                                <img class="w-full h-full" src="/storage/image/{{$slika->photo}}" alt="">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="mx-[40px] flex items-center px-6 py-4 my-4 text-lg bg-red-200 rounded-lg">
                <p class="font-medium text-red-600"> Knjiga {{$knjiga->title}} nema slike! </p>
            </div>
        @endif
        </div>
    </div>
@endsection
