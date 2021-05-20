@extends('layouts.layout')

@section('knjigaOsnovniDetalji')

    <section class="w-screen h-screen pl-[80px] pb-2 text-gray-700">
        <!-- Heading of content -->
        <div class="heading">
            <div class="flex flex-row justify-between border-b-[1px] border-[#e4dfdf]">
                <div class="py-[10px] flex flex-row">
                    <div class="w-[77px] pl-[30px]">
                        <img src="../img/tomsojer.jpg" alt="">
                    </div>
                    <div class="pl-[15px]  flex flex-col">
                        <div>
                            <h1>
                                {{$knjiga->title}}
                            </h1>
                        </div>
                        <div>
                            <nav class="w-full rounded">
                                <ol class="flex list-reset">
                                    <li>
                                        <a href="{{route('evidencijaKnjiga')}}" class="text-[#2196f3] hover:text-blue-600">
                                            Evidencija knjiga
                                        </a>
                                    </li>
                                    <li>
                                        <span class="mx-2">/</span>
                                    </li>
                                    <li>
                                        <a href="{{route('knjigaOsnovniDetalji', ['knjiga' => $knjiga])}}"
                                           class="text-[#2196f3] hover:text-blue-600">
                                            KNJIGA-{{$knjiga->id}}
                                        </a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="pt-[24px] mr-[30px]">
                    <a href="{{route('otpisiKnjigu', ['knjiga' => $knjiga->id])}}" class="inline hover:text-blue-600">
                        <i class="fas fa-level-up-alt mr-[3px]"></i>
                        Otpisi knjigu
                    </a>
                    <a href="{{route('izdajKnjigu', ['knjiga' => $knjiga])}}" class="inline hover:text-blue-600 ml-[20px] pr-[10px]">
                        <i class="far fa-hand-scissors mr-[3px]"></i>
                        Izdaj knjigu
                    </a>
                    <a href="{{route('vratiKnjigu', ['knjiga' => $knjiga->id])}}" class="hover:text-blue-600 inline ml-[20px] pr-[10px]">
                        <i class="fas fa-redo-alt mr-[3px] "></i>
                        Vrati knjigu
                    </a>
                    <a href="{{route('rezervisiKnjigu', ['knjiga' => $knjiga])}}" class="hover:text-blue-600 inline ml-[20px] pr-[10px]">
                        <i class="far fa-calendar-check mr-[3px] "></i>
                        Rezervisi knjigu
                    </a>
                    <p class="inline cursor-pointer text-[25px] py-[10px] pl-[30px] border-l-[1px] border-[#e4dfdf] dotsKnjigaOsnovniDetalji hover:text-[#606FC7]">
                        <i
                            class="fas fa-ellipsis-v"></i>
                    </p>
                    <div
                        class="z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 dropdown-knjiga-osnovni-detalji">
                        <div class="absolute right-0 w-56 mt-[7px] origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                             aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                            <div class="py-1">
                                <a href="{{route('editKnjiga', ['knjiga' => $knjiga])}}" tabindex="0"
                                   class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                   role="menuitem">
                                    <i class="fas fa-edit mr-[1px] ml-[5px] py-1"></i>
                                    <span class="px-4 py-0">Izmijeni knjigu</span>
                                </a>
                                <a href="{{route('izbrisiKnjigu', ['knjiga' => $knjiga->id])}}" tabindex="0"
                                   class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                   role="menuitem">
                                    <i class="fa fa-trash mr-[5px] ml-[5px] py-1"></i>
                                    <span class="px-4 py-0">Izbrisi knjigu</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row overflow-auto height-osnovniDetalji">
            <!-- PLACE FOR YIELDING BOOK SECTIONS -->
            @yield('osnovniDetalji')
            @yield('specifikacijaKnjige')
            @yield('izdateIznajmljivanje')
            @yield('prekoracenjeIznajmljivanje')
            @yield('vraceneIznajmljivanje')
            @yield('aktivneIznajmljivanje')
            @yield('arhiviraneIznajmljivanje')
            @yield('knjigeMultimedija')
            <div class="min-w-[20%] border-l-[1px] border-[#e4dfdf] ">
                <div class="border-b-[1px] border-[#e4dfdf]">
                    <div class="ml-[30px] mr-[70px] mt-[20px] flex flex-row justify-between">
                        <div class="text-gray-500 ">
                            <p>Na raspolaganju:</p>
                            <p class="mt-[20px]">Rezervisano:</p>
                            <p class="mt-[20px]">Izdato:</p>
                            <p class="mt-[20px]">U prekoracenju:</p>
                            <p class="mt-[20px]">Ukupna kolicina:</p>
                        </div>
                        <div class="text-center pb-[30px]">
                            <p class=" bg-green-200 text-green-700 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                {{$knjiga->quantity - $knjiga->reservedBooks - $knjiga->rentedBooks}} primjeraka
                            </p>
                            <a href="{{route('iznajmljivanjeAktivne', ['knjiga' => $knjiga->id])}}"><p
                                    class=" mt-[16px] bg-yellow-200 text-yellow-700 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                    {{$knjiga->reservedBooks}} primjerka</p></a>
                            <a href="{{route('iznajmljivanjeIzdate', ['knjiga' => $knjiga->id])}}"><p
                                    class=" mt-[16px] bg-blue-200 text-blue-800 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                    {{$knjiga->rentedBooks}} primjerka</p></a>
                            <a href="{{route('iznajmljivanjePrekoracenje', ['knjiga' => $knjiga->id])}}">
                                <p class=" mt-[16px] bg-red-200 text-red-800 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                    {{\App\Models\Rent::where('return_date', '=', null)->where('rent_date', '<', Carbon\Carbon::now()->subDays(30))->where('book_id', '=', $knjiga->id)->count()}} primjerka
                                </p>
                            </a>
                            <p
                                class=" mt-[16px] border-[1px] border-green-700 text-green-700 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                {{$knjiga->quantity}} primjeraka
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mx-[30px]">
                    @foreach($aktivnosti as $aktivnost)
                        <div class="mt-[40px] flex flex-col max-w-[304px]">
                            <div class="text-gray-500 ">
                                <p class="inline uppercase">
                                    Izdavanja knjige
                                </p>
                                <span>
                                        - {{$aktivnost->rent_date->diffForHumans()}}
                                    </span>
                            </div>
                            <div>
                                <p>
                                    <a href="{{route('bibliotekarProfile', ['bibliotekar' => $aktivnost->librarian])}}" class="text-[#2196f3] hover:text-blue-600">
                                        {{$aktivnost->librarian->name}}
                                    </a>
                                    rented a book to
                                    <a href="{{route('ucenikProfile', ['ucenik' => $aktivnost->student])}}" class="text-[#2196f3] hover:text-blue-600">
                                        {{$aktivnost->student->name}}
                                    </a>
                                    on
                                    <span class="font-medium">
                                        {{$aktivnost->rent_date->toDateString()}}.
                                    </span>
                                </p>
                            </div>
                            <div>
                                <a href="{{route('izdavanjeDetalji', ['knjiga' => $aktivnost->book, 'ucenik' => $aktivnost->student])}}" class="text-[#2196f3] hover:text-blue-600">
                                    more details >>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    @if($aktivnosti->count() > 0 )
                            <div class="mt-[40px]">
                                <a href="{{route('dashboardAktivnostKonkretneKnjige', ['knjiga' => $aktivnost->book])}}" class="text-[#2196f3] hover:text-blue-600">
                                    <i class="fas fa-history"></i> Prikazi sve
                                </a>
                            </div>
                        @else
                            <div class="mt-[40px] flex flex-col max-w-[304px]">
                                <div class="text-gray-500 ">
                                    <p class="inline uppercase">
                                        NEMA INFORMACIJA O AKTIVNOSTIMA
                                    </p>
                                </div>
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </section>

@endsection
