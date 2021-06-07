@extends('layouts.knjiga')
@section('specifikacijaKnjige')
    <div class="w-[80%]">
        <div class="border-b-[1px] py-4 text-gray-500 border-[#e4dfdf] pl-[30px]">
            <a href="{{route('knjigaOsnovniDetalji', ['knjiga' => $knjiga])}}" class="inline hover:text-blue-800">
                Osnovni detalji
            </a>
            <a href="{{route('knjigaSpecifikacija', ['knjiga' => $knjiga])}}" class="inline ml-[70px] active-book-nav hover:text-blue-800">
                Specifikacija
            </a>
            <a href="{{route('iznajmljivanjeIzdate', ['knjiga' => $knjiga])}}" class="inline ml-[70px] hover:text-blue-800">
                Evidencija iznajmljivanja
            </a>
            <a href="{{route('evidencijaKnjigaMultimedija', ['knjiga' => $knjiga])}}" class="inline ml-[70px] hover:text-blue-800">
                Multimedija
            </a>
        </div>
        <div class="">
            <!-- Space for content -->
            <div class="pl-[30px] section- mt-[20px]">
                <div class="flex flex-row justify-between">
                    <div class="mr-[30px]">
                        <div class="mt-[20px]">
                            <span class="text-gray-500 text-[14px]">Broj strana</span>
                            <p class="font-medium">{{$knjiga->pages}}</p>
                        </div>
                        <div class="mt-[40px]">
                            <span class="text-gray-500 text-[14px]">Pismo</span>
                            <p class="font-medium">{{$knjiga->script->name}}</p>
                        </div>
                        <div class="mt-[40px]">
                            <span class="text-gray-500 text-[14px]">Jezik</span>
                            <p class="font-medium">{{$knjiga->language->name}}</p>
                        </div>
                        <div class="mt-[40px]">
                            <span class="text-gray-500 text-[14px]">Povez</span>
                            <p class="font-medium">{{$knjiga->binding->name}}</p>
                        </div>
                        <div class="mt-[40px]">
                            <span class="text-gray-500 text-[14px]">Format</span>
                            <p class="font-medium">{{$knjiga->format->name}}</p>
                        </div>
                        <div class="mt-[40px]">
                                        <span class="text-gray-500 text-[14px]">Međunarodni standardni broj knjige
                                            (ISBN)</span>
                            <p class="font-medium">{{$knjiga->ISBN}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
