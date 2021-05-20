@extends('layouts.layout')
@section('dashboardAktivnost')
    <section class="w-screen h-screen pl-[80px] py-4 text-gray-700">
        <!-- Heading of content -->
        <div class="heading mt-[7px]">
            <h1 class="pl-[30px] pb-[21px]  border-b-[1px] border-[#e4dfdf] ">
                Prikaz aktivnosti
            </h1>
        </div>
        <!-- Space for content -->
        <div class="pl-[30px] overflow-auto scroll height-dashboard pb-[30px] mt-[20px]">
            <div class="flex flex-row justify-between">
                <div class="mr-[30px]">
                    <form>
                        @csrf
                        <div class="text-[14px] flex flex-row mb-[30px]">
                        <div class="">
                            <div class="rounded">
                                <div class="relative">
                                    <a class="w-auto rounded cursor-pointer focus:outline-none uceniciDrop-toggle">
                                                <span id="uceniciSvi" class="float-left">Ucenici: Svi </span>
                                                <i
                                                        class="px-[7px] fas fa-angle-down"></i>
                                    </a>
                                    <div id="uceniciDropdown"
                                         class="uceniciMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] pin-l border-2 border-gray-300">
                                        <ul class="border-b-2 border-gray-300 list-reset">
                                            <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                <input class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                                       placeholder="Search"
                                                       onkeyup="filterFunction('searchUcenici', 'uceniciDropdown', 'dropdown-item-izdato')"
                                                       id="searchUcenici"><br>
                                                <button
                                                    class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </li>
                                            <div class="h-[200px] scroll">
                                                @foreach($ucenici as $ucenik)
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-izdato">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0 uceniciFilterPonisti" name="uceniciFilter[]" value="{{$ucenik->id}}">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                 viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <img width="40px" height="30px" class="ml-[15px] rounded-full"
                                                         src="img/profileStudent.jpg">
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        {{$ucenik->name}}
                                                    </p>
                                                </li>
                                                @endforeach
                                            </div>
                                        </ul>
                                        <div class="flex pt-[10px] text-white ">
                                            <a href="#" id="uceniciFilter"
                                               class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                            </a>
                                            <a href="#" id="uceniciFilterPonisti"
                                               class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-[25px]">
                            <div class="rounded">
                                <div class="relative">
                                    <a class="inline-block w-auto rounded cursor-pointer focus:outline-none bibliotekariDrop-toggle">
                                                <span id="bibliotekariSvi" class="float-left">Bibliotekari: Svi </span><i
                                                        class="px-[7px] fas fa-angle-down"></i>
                                    </a>
                                    <div id="bibliotekariDropdown"
                                         class="bibliotekariMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md pin-t pin-l border-2 border-gray-300">
                                        <ul class="border-b-2 border-gray-300 list-reset">
                                            <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                <input class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                                       placeholder="Search"
                                                       onkeyup="filterFunction('searchBibliotekari', 'bibliotekariDropdown', 'dropdown-item-bibliotekar')"
                                                       id="searchBibliotekari"><br>
                                                <button
                                                    class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </li>
                                            <div class="h-[200px] scroll">
                                                @foreach($bibliotekari as $bibliotekar)
                                                    <li
                                                        class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-bibliotekar">
                                                        <label class="flex items-center justify-start">
                                                            <div
                                                                class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                                <input type="checkbox" class="absolute opacity-0 bibliotekariFilterPonisti" name="bibliotekariFilter[]" value="{{$bibliotekar->id}}">
                                                                <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                     viewBox="0 0 20 20">
                                                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                                </svg>
                                                            </div>
                                                        </label>
                                                        <img width="40px" height="30px" class="ml-[15px] rounded-full"
                                                             src="img/profileExample.jpg">
                                                        <p id="bibliotekariFilter"
                                                            class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                            {{$bibliotekar->name}}
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </div>
                                        </ul>
                                        <div class="flex pt-[10px] text-white ">
                                            <a href="#" id="bibliotekariFilter"
                                               class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                            </a>
                                            <a href="#" id="bibliotekariFilterPonisti"
                                               class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-[25px]">
                            <div class="rounded">
                                <div class="relative">
                                    <a class="inline-block w-auto rounded cursor-pointer focus:outline-none" id="knjigeMenu">
                                        @if($knjiga != null)
                                            <span id="knjigeSvi" class='float-left bg-blue-200 text-blue-800 px-[5px]'>
                                                Knjige:  {{$knjiga->title}}
                                            </span>
                                            <i class="px-[7px] fas fa-angle-down"></i>

                                        @else
                                            <span id="knjigeSvi" class='float-left'>
                                                Knjiga:  Sve
                                            </span>
                                            <i class="px-[7px] fas fa-angle-down"></i>
                                        @endif

                                    </a>
                                    <div id="knjigeDropdown"
                                         class="knjigeMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md pin-t pin-l border-2 border-gray-300">
                                        <ul class="border-b-2 border-gray-300 list-reset">
                                            <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                <input class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                                       placeholder="Search"
                                                       onkeyup="filterFunction('searchKnjige', 'knjigeDropdown', 'dropdown-item-knjiga')"
                                                       id="searchKnjige"><br>
                                                <button
                                                    class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </li>
                                            <div class="h-[200px] scroll">
                                                @foreach($knjige as $k)
                                                    <li
                                                        class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-knjiga">
                                                        <label class="flex items-center justify-start">
                                                            <div
                                                                class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                                <input type="checkbox" class="absolute opacity-0 knjigeFilterPonisti" name="knjigeFilter[]" value="{{$k->id}}">
                                                                <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                     viewBox="0 0 20 20">
                                                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                                </svg>
                                                            </div>
                                                        </label>
                                                        <img width="30px" height="30px" class="ml-[15px]"
                                                             src="img/tomsojer.jpg">
                                                        <p id="knjigeFilter"
                                                            class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                            {{$k->title}}
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </div>
                                        </ul>
                                        <div class="flex pt-[10px] text-white ">
                                            <a href="#" id="knjigeFilter"
                                               class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                            </a>
                                            <a href="#" id="knjigeFilterPonisti"
                                               class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-[25px]">
                            <div class="rounded">
                                <div class="relative">
                                    <a class="inline-block w-auto rounded cursor-pointer focus:outline-none" id="transakcijeMenu">
                                                <span class="float-left">Transakcije: Sve <i
                                                        class="px-[7px] fas fa-angle-down"></i></span>
                                    </a>
                                    <div id="transakcijeDropdown"
                                         class="transakcijeMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md pin-t pin-l border-2 border-gray-300">
                                        <ul class="border-b-2 border-gray-300 list-reset">
                                            <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                <input class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                                       placeholder="Search"
                                                       onkeyup="filterFunction('searchTransakcije', 'transakcijeDropdown', 'dropdown-item-transakcije')"
                                                       id="searchTransakcije"><br>
                                                <button
                                                    class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </li>
                                            <div class="h-[200px] scroll">
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-transakcije">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                 viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Izdavanje knjiga
                                                    </p>
                                                </li>
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-transakcije">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                 viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Vracanje knjiga
                                                    </p>
                                                </li>
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-transakcije">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                 viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Unos nove knjige
                                                    </p>
                                                </li>
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-transakcije">
                                                    <label class="flex items-center justify-start">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                            <input type="checkbox" class="absolute opacity-0">
                                                            <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                 viewBox="0 0 20 20">
                                                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Brisanje knjige
                                                    </p>
                                                </li>
                                            </div>
                                        </ul>
                                        <div class="flex pt-[10px] text-white ">
                                            <a href="#"
                                               class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#009688] bg-[#46A149] rounded-[5px]">
                                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                            </a>
                                            <a href="#"
                                               class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-[25px]">
                            <div class="rounded">
                                <div class="relative">
                                    <a class="inline-block w-auto rounded cursor-pointer focus:outline-none datumDrop-toggle">
                                                <span id="datumSvi" class="float-left">
                                                    Datum: Svi
                                                </span>
                                                <i class="px-[7px] fas fa-angle-down"></i>
                                    </a>
                                    <div id="datumDropdown"
                                         class="datumMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md pin-t pin-l border-2 border-gray-300">
                                        <div
                                            class="flex justify-between flex-row p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                            <div>
                                                <label class="font-medium text-gray-500">Period od:</label>
                                                <input type="date"
                                                       class="border-[1px] border-[#e4dfdf]  cursor-pointer focus:outline-none datumFilterPonisti" id="datumOdFilter">
                                            </div>
                                            <div class="ml-[50px]">
                                                <label class="font-medium text-gray-500">Period do:</label>
                                                <input type="date"
                                                       class="border-[1px] border-[#e4dfdf]  cursor-pointer focus:outline-none datumFilterPonisti" id="datumDoFilter">
                                            </div>
                                        </div>
                                        <div class="flex pt-[10px] text-white ">
                                            <a href="#" id="datumFilter"
                                               class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#009688] bg-[#46A149] rounded-[5px]">
                                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                            </a>
                                            <a href="#" id="datumFilterPonisti"
                                               class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('dashboardAktivnost')}}" class="ml-[35px] cursor-pointer hover:text-blue-600">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    </div>
                    </form>
                    <!-- Activity Cards -->
                    <div id="activityCards">
                        @foreach($aktivnosti as $aktivnost)
                            <div class="activity-card hidden flex flex-row mb-[30px]">
                                <div class="w-[60px] h-[60px]">
                                    <img class="rounded-full" src="img/profileStudent.jpg" alt="">
                                </div>
                                <div class="ml-[15px] mt-[5px] flex flex-col">
                                    <div class="text-gray-500 mb-[5px]">
                                        <p class="uppercase">
                                            Izdavanje knjige
                                            <span class="inline lowercase">
                                            - {{$aktivnost->rent_date->diffForHumans()}}
                                        </span>
                                        </p>
                                    </div>
                                    <div class="">
                                        <p>
                                            <a href="{{route('bibliotekarProfile', ['bibliotekar' => $aktivnost->librarian])}}" class="text-[#2196f3] hover:text-blue-600">
                                                {{$aktivnost->librarian->name}}
                                            </a>
                                            rented a book
                                            <a  href="{{route('knjigaOsnovniDetalji', ['knjiga' => $aktivnost->book])}}" class="font-medium">
                                                {{$aktivnost->book->title}}
                                            </a>
                                            to
                                            <a href="{{route('ucenikProfile', ['ucenik' => $aktivnost->student])}}" class="text-[#2196f3] hover:text-blue-600">
                                                {{$aktivnost->student->name}}
                                            </a>
                                            on
                                            <span class="font-medium">
                                        {{$aktivnost->rent_date}}.
                                    </span>
                                            <a href="{{route('izdavanjeDetalji', ['knjiga' => $aktivnost->book])}}" class="text-[#2196f3] hover:text-blue-600">
                                                more details >>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="inline-block w-full mt-4">
                        <button type="button"
                                class="btn-animation w-full px-4 py-2 text-sm tracking-wider text-gray-600 transition duration-300 ease-in border-[1px] border-gray-400 rounded activity-showMore hover:bg-gray-200 focus:outline-none focus:ring-[1px] focus:ring-gray-300">
                            Show more
                        </button>
                    </div>
                    </div>
                    <div id="activityCards2" style="display: none">

                    </div>
                    <div id="activityCards3" style="display: none">
                        Ne postoje rezultati za trazene kriterijume!
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection
