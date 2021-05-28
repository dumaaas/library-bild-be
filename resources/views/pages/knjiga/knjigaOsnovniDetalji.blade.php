@extends('layouts.knjiga')
@section('osnovniDetalji')
    <div class="w-[80%]">
        <div class="border-b-[1px] py-4 text-gray-500 border-[#e4dfdf] pl-[30px]">
            <a href="{{route('knjigaOsnovniDetalji', ['knjiga' => $knjiga])}}" class="active-book-nav inline hover:text-blue-800">
                Osnovni detalji
            </a>
            <a href="{{route('knjigaSpecifikacija', ['knjiga' => $knjiga])}}" class="inline ml-[70px] hover:text-blue-800">
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
                            <span class="text-gray-500 text-[14px]">Naziv knjige</span>
                            <p class="font-medium">{{$knjiga->title}}</p>
                        </div>
                        <div class="mt-[40px]">
                            <span class="text-gray-500 text-[14px]">Kategorija</span>
                            <p class="font-medium">
                                @foreach($knjiga->category as $kategorija)
                                    {{$kategorija->category->name}}
                                    {{ $loop->last ? '' : ',' }}
                                @endforeach
                            </p>
                        </div>
                        <div class="mt-[40px]">
                            <span class="text-gray-500 text-[14px]">Zanr</span>
                            <p class="font-medium">
                                @foreach($knjiga->genre as $zanr)
                                    {{$zanr->genre->name}}
                                    {{ $loop->last ? '' : ',' }}
                                @endforeach
                            </p>
                        </div>
                        <div class="mt-[40px]">
                            <span class="text-gray-500 text-[14px]">Autor/ri</span>
                            <p class="font-medium">
                                @foreach($knjiga->author as $autor)
                                    {{$autor->author->name}}
                                    {{ $loop->last ? '' : ',' }}
                                @endforeach
                            </p>
                        </div>
                        <div class="mt-[40px]">
                            <span class="text-gray-500 text-[14px]">Izdavac</span>
                            <p class="font-medium">
                                {{$knjiga->publisher->name}}
                            </p>
                        </div>
                        <div class="mt-[40px]">
                            <span class="text-gray-500 text-[14px]">Godina izdavanja</span>
                            <p class="font-medium">{{$knjiga->publishYear}}</p>
                        </div>
                    </div>
                    <div class="mr-[70px] mt-[20px] flex flex-col max-w-[600px]">
                        <div>
                            <h4 class="text-gray-500 ">
                                Storyline (Kratki sadrzaj)
                            </h4>
                            <p class="addReadMore showlesscontent my-[10px]">
                                {{$knjiga->summary}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
