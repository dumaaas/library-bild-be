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
                                        <a href="evidencijaKnjiga.php" class="text-[#2196f3] hover:text-blue-600">
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
                    <a href="otpisiKnjigu.php" class="inline hover:text-blue-600">
                        <i class="fas fa-level-up-alt mr-[3px]"></i>
                        Otpisi knjigu
                    </a>
                    <a href="izdajKnjigu.php" class="inline hover:text-blue-600 ml-[20px] pr-[10px]">
                        <i class="far fa-hand-scissors mr-[3px]"></i>
                        Izdaj knjigu
                    </a>
                    <a href="vratiKnjigu.php" class="hover:text-blue-600 inline ml-[20px] pr-[10px]">
                        <i class="fas fa-redo-alt mr-[3px] "></i>
                        Vrati knjigu
                    </a>
                    <a href="rezervisiKnjigu.php" class="hover:text-blue-600 inline ml-[20px] pr-[10px]">
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
                                <a href="editKnjiga.php" tabindex="0"
                                   class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                   role="menuitem">
                                    <i class="fas fa-edit mr-[1px] ml-[5px] py-1"></i>
                                    <span class="px-4 py-0">Izmijeni knjigu</span>
                                </a>
                                <a href="#" tabindex="0"
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
                                0 primjeraka</p>
                            <a href="iznajmljivanjeAktivne.php"><p
                                    class=" mt-[16px] bg-yellow-200 text-yellow-700 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                    {{$knjiga->reservedBooks}} primjerka</p></a>
                            <a href="iznajmljivanjeIzdate.php"><p
                                    class=" mt-[16px] bg-blue-200 text-blue-800 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                    {{$knjiga->rentedBooks}} primjerka</p></a>
                            <a href="iznajmljivanjePrekoracenje.php">  <p
                                    class=" mt-[16px] bg-red-200 text-red-800 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                    0 primjerka</p></a>
                            <p
                                class=" mt-[16px] border-[1px] border-green-700 text-green-700 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                {{$knjiga->quantity}} primjeraka
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-[40px] mx-[30px]">
                    <div class="flex flex-col max-w-[304px]">
                        <div class="text-gray-500 ">
                            <p class="inline uppercase">
                                Izdavanja knjige
                            </p>
                            <span>
                                    - 4 days ago
                                </span>
                        </div>
                        <div>
                            <p>
                                <a href="bibliotekarProfile.php" class="text-[#2196f3] hover:text-blue-600">
                                    Valentina K.
                                </a>
                                je izdala knjigu
                                <a href="ucenikProfile.php" class="text-[#2196f3] hover:text-blue-600">
                                    Peru Perovicu
                                </a>
                                dana
                                <span class="font-medium">
                                        21.02.2021.
                                    </span>
                            </p>
                        </div>
                        <div>
                            <a href="izdavanjeDetalji.php" class="text-[#2196f3] hover:text-blue-600">
                                pogledaj detaljnije >>
                            </a>
                        </div>
                    </div>
                    <div class="mt-[40px] flex flex-col max-w-[304px]">
                        <div class="text-gray-500 ">
                            <p class="inline uppercase">
                                Izdavanja knjige
                            </p>
                            <span>
                                    - 4 days ago
                                </span>
                        </div>
                        <div>
                            <p>
                                <a href="bibliotekarProfile.php" class="text-[#2196f3] hover:text-blue-600">
                                    Valentina K.
                                </a>
                                je izdala knjigu
                                <a href="ucenikProfile.php" class="text-[#2196f3] hover:text-blue-600">
                                    Peru Perovicu
                                </a>
                                dana
                                <span class="font-medium">
                                        21.02.2021.
                                    </span>
                            </p>
                        </div>
                        <div>
                            <a href="izdavanjeDetalji.php" class="text-[#2196f3] hover:text-blue-600">
                                pogledaj detaljnije >>
                            </a>
                        </div>
                    </div>
                    <div class="mt-[40px] flex flex-col max-w-[304px]">
                        <div class="text-gray-500 ">
                            <p class="inline uppercase">
                                Izdavanja knjige
                            </p>
                            <span>
                                    - 4 days ago
                                </span>
                        </div>
                        <div>
                            <p>
                                <a href="bibliotekarProfile.php" class="text-[#2196f3] hover:text-blue-600">
                                    Valentina K.
                                </a>
                                je izdala knjigu
                                <a href="ucenikProfile.php" class="text-[#2196f3] hover:text-blue-600">
                                    Peru Perovicu
                                </a>
                                dana
                                <span class="font-medium">
                                        21.02.2021.
                                    </span>
                            </p>
                        </div>
                        <div>
                            <a href="izdavanjeDetalji.php" class="text-[#2196f3] hover:text-blue-600">
                                pogledaj detaljnije >>
                            </a>
                        </div>
                    </div>
                    <div class="mt-[40px]">
                        <a href="dashboardAktivnost.php?knjiga=Tom Sojer" class="text-[#2196f3] hover:text-blue-600">
                            <i class="fas fa-history"></i> Prikazi sve
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
