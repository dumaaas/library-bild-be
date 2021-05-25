@extends('layouts.layout')

@section('vraceneKnjige')
<section class="w-screen h-screen pl-[80px] py-4 text-gray-700">
            <!-- Heading of content -->
            <div class="heading mt-[7px]">
                <h1 class="pl-[30px] pb-[21px] border-b-[1px] border-[#e4dfdf] ">
                    Izdavanje knjiga
                </h1>
            </div>
            <!-- Space for content -->
            <div class="scroll height-dashboard">
                <div class="flex items-center px-6 py-4 space-x-3 rounded-lg ml-[292px]">
                    <div class="flex items-center">
                        <div class="relative text-gray-600 focus-within:text-gray-400">
                            <input type="search" name="q"
                                class="py-2 pl-2 text-sm text-white bg-white border-2 border-gray-200 rounded-md focus:outline-none focus:bg-white focus:text-gray-900 w-[600px]"
                                placeholder="Pretrazi knjige..." autocomplete="off">
                        </div>
                    </div>
                    <a href="#"
                        class="btn-animation inline-flex items-center text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] tracking-wider text-white bg-[#3f51b5] rounded hover:bg-[#4558BE]">Pretrazi
                    </a>
                </div>
                <div>
                    <!-- Space for content -->
                    <div class="flex justify-start pt-3 bg-white">
                        <div class="mt-[10px]">
                            <ul class="text-[#2D3B48]">
                                <li class="mb-[4px]">
                                    <div class="w-[300px] pl-[32px]">
                                        <span
                                            class=" whitespace-nowrap w-full text-[25px]  flex justify-between fill-current">
                                            <div
                                                class="py-[15px] px-[20px] w-[268px] cursor-pointer group hover:bg-[#EFF3F6] rounded-[10px]">
                                                <a href="{{route('izdateKnjige')}}" aria-label="Sve knjige"
                                                    class="flex items-center">
                                                    <i
                                                        class="text-[#707070] transition duration-300 ease-in group-hover:text-[#576cdf] far fa-copy text-[20px]"></i>
                                                    <div>
                                                        <p
                                                            class="transition duration-300 ease-in group-hover:text-[#576cdf]  text-[15px] ml-[18px]">
                                                            Izdate knjige
                                                        </p>
                                                    </div>
                                                </a>
                                            </div>
                                        </span>
                                    </div>
                                </li>
                                <li class="mb-[4px]">
                                    <div class="w-[300px] pl-[32px]">
                                        <span
                                            class=" whitespace-nowrap w-full text-[25px] flex justify-between fill-current">
                                            <div
                                                class="group bg-[#EFF3F6] hover:bg-[#EFF3F6] py-[15px] px-[20px] w-[268px] rounded-[10px] cursor-pointer">
                                                <a href="{{route('vraceneKnjige')}}" aria-label="Vracene knjige"
                                                    class="flex items-center">
                                                    <i
                                                        class="transition duration-300 ease-in  text-[#707070] text-[20px] fas fa-file text-[#576cdf]"></i>
                                                    <div>
                                                        <p
                                                            class="transition duration-300 ease-in  text-[15px] ml-[21px] text-[#576cdf]">
                                                            Vracene knjige
                                                        </p>
                                                    </div>
                                                </a>
                                            </div>
                                        </span>
                                    </div>
                                </li>
                                <li class="mb-[4px]">
                                    <div class="w-[300px] pl-[28px]">
                                        <span
                                            class=" whitespace-nowrap w-full text-[25px] flex justify-between fill-current">
                                            <div
                                                class="group hover:bg-[#EFF3F6] py-[15px] px-[20px] w-[268px] rounded-[10px] cursor-pointer">
                                                <a href="{{route('knjigePrekoracenje')}}" aria-label="Knjige na raspolaganju"
                                                    class="flex items-center">
                                                    <i
                                                        class="text-[#707070] text-[20px] fas fa-exclamation-triangle transition duration-300 ease-in group-hover:text-[#576cdf]"></i>
                                                    <div>
                                                        <p
                                                            class="text-[15px] ml-[17px] transition duration-300 ease-in group-hover:text-[#576cdf]">
                                                            Knjige u prekoracenju</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </span>
                                    </div>
                                </li>
                                <li class="mb-[4px]">
                                    <div class="w-[300px] w-[300px] border-t-[1px] border-[#e4dfdf]">
                                        <span
                                            class=" pl-[32px] whitespace-nowrap w-full text-[25px] flex justify-between fill-current">
                                            <div
                                                class="group hover:bg-[#EFF3F6] py-[15px] px-[20px] w-[268px] rounded-[10px] cursor-pointer">
                                                <a href="{{route('aktivneRezervacije')}}" aria-label="Rezervacije"
                                                    class="flex items-center">
                                                    <i
                                                        class="text-[#707070] text-[20px] far fa-calendar-check transition duration-300 ease-in group-hover:text-[#576cdf]"></i>
                                                    <div>
                                                        <p
                                                            class="text-[15px] ml-[19px] transition duration-300 ease-in group-hover:text-[#576cdf]">
                                                            Aktivne rezervacije</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </span>
                                    </div>
                                </li>
                                <li class="mb-[4px]">
                                    <div class="w-[300px] pl-[32px]">
                                        <span
                                            class=" whitespace-nowrap w-full text-[25px] flex justify-between fill-current">
                                            <div
                                                class="group hover:bg-[#EFF3F6] py-[15px] px-[20px] w-[268px] rounded-[10px] cursor-pointer">
                                                <a href="{{route('arhiviraneRezervacije')}}" aria-label="Rezervacije"
                                                    class="flex items-center">
                                                    <i
                                                        class="text-[#707070] text-[20px] fas fa-calendar-alt transition duration-300 ease-in group-hover:text-[#576cdf]"></i>
                                                    <div>
                                                        <p
                                                            class="text-[15px] ml-[19px] transition duration-300 ease-in group-hover:text-[#576cdf]">
                                                            Arhivirane rezervacije</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="w-full mt-[10px] ml-2 px-2">
                            @if(count($vracene) > 0)
                                <table class="w-full shadow-lg" id="myTable">
                                    <thead class="bg-[#EFF3F6]">
                                        <form action="/filterVraceneKnjige" method="GET">
                                            <tr class="border-b-[1px] border-[#e4dfdf]">
                                                <th class="px-4 py-4 leading-4 tracking-wider text-left text-blue-500">
                                                    <label class="inline-flex items-center">
                                                        <input type="checkbox" class="form-checkbox">
                                                    </label>
                                                </th>
                                                <th class="px-4 py-4 leading-4 tracking-wider text-left">
                                                    Naziv knjige
                                                    <a href="#"><i class="ml-2 fa-lg fas fa-long-arrow-alt-down"
                                                            onclick="sortTable()"></i>
                                                    </a>
                                                </th>
                                                <!-- Izdato uceniku + dropdown filter for ucenik -->
                                                <th
                                                    class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer ">
                                                    Izdato uceniku<i class="ml-2 fas fa-filter uceniciDrop-toggle"></i>
                                                    <div id="uceniciDropdown"
                                                        class="uceniciMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] pin-t pin-l border-2 border-gray-300">
                                                        <ul class="border-b-2 border-gray-300 list-reset">
                                                            <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                                <input
                                                                    class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                                                    placeholder="Search"
                                                                    onkeyup="filterFunction('searchUcenici', 'uceniciDropdown', 'dropdown-item-ucenik')"
                                                                    id="searchUcenici"><br>
                                                                <button
                                                                    class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                                                    <i class="fas fa-search"></i>
                                                                </button>
                                                            </li>
                                                            <div class="h-[200px] scroll font-normal">
                                                                @foreach($ucenici as $ucenik)
                                                                        <li
                                                                            class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-ucenik">
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
                                                                            <img width="40px" height="30px"
                                                                                class="ml-[15px] rounded-full"
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
                                                            <button
                                                                class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                                            </button>
                                                            <a id="uceniciFilterPonisti"
                                                                class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </th>
                                                <!-- Datum izdavanja + dropdown filter for date -->
                                                <th
                                                    class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer ">
                                                    Datum izdavanja<i class="fas fa-filter datumDrop-toggle"></i>
                                                    <div id="datumDropdown"
                                                        class="datumMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] pin-l border-2 border-gray-300">
                                                        <div
                                                            class="flex justify-between flex-row p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                            <div>
                                                                <label class="font-medium text-gray-500">Period od:</label>
                                                                <input type="date"
                                                                    class="datumFilterPonisti border-[1px] border-[#e4dfdf]  cursor-pointer focus:outline-none" name="filterDatumOd">
                                                            </div>
                                                            <div class="ml-[50px]">
                                                                <label class="font-medium text-gray-500">Period do:</label>
                                                                <input type="date"
                                                                    class="datumFilterPonisti border-[1px] border-[#e4dfdf]  cursor-pointer focus:outline-none" name="filterDatumDo">
                                                            </div>
                                                        </div>
                                                        <div class="flex pt-[10px] text-white ">
                                                            <button
                                                                class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                                            </button>
                                                            <a id="datumFilterPonisti"
                                                                class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </th>
                                                <!-- Datum vracanja + dropdown filter for date -->
                                                <th
                                                    class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer ">
                                                    Datum vracanja<i class="fas fa-filter vracanjeDrop-toggle"></i>
                                                    <div id="vracanjeDropdown"
                                                        class="vracanjeMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] right-0 border-2 border-gray-300">
                                                        <div
                                                            class="flex justify-between flex-row p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                            <div>
                                                                <label class="font-medium text-gray-500">Period od:</label>
                                                                <input type="date"
                                                                    class="vracenaFilterPonisti border-[1px] border-[#e4dfdf]  cursor-pointer focus:outline-none" name="filterVracenaOd">
                                                            </div>
                                                            <div class="ml-[50px]">
                                                                <label class="font-medium text-gray-500">Period do:</label>
                                                                <input type="date"
                                                                    class="vracenaFilterPonisti border-[1px] border-[#e4dfdf]  cursor-pointer focus:outline-none" name="filterVracenaDo">
                                                            </div>
                                                        </div>
                                                        <div class="flex pt-[10px] text-white ">
                                                            <button
                                                                class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                                            </button>
                                                            <a id="vracenaFilterPonisti"
                                                                class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </th>
                                                <!-- Zadrzavanje knjige + dropdown filter for date -->
                                                <th
                                                    class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer ">
                                                    Zadrzavanje knjige
                                                </th>
                                                <!-- Knjigu primio + dropdown filter for bibliotekari -->
                                                <th
                                                    class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer ">
                                                    Knjigu primio<i class="fas fa-filter bibliotekariDrop-toggle"></i>
                                                    <div id="bibliotekariDropdown"
                                                        class="bibliotekariMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] right-0 border-2 border-gray-300">
                                                        <ul class="border-b-2 border-gray-300 list-reset">
                                                            <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                                <input
                                                                    class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                                                    placeholder="Search"
                                                                    onkeyup="filterFunction('searchBibliotekari', 'bibliotekariDropdown', 'dropdown-item-bibliotekar')"
                                                                    id="searchBibliotekari"><br>
                                                                <button
                                                                    class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                                                    <i class="fas fa-search"></i>
                                                                </button>
                                                            </li>
                                                            <div class="h-[200px] scroll font-normal">
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
                                                                        <img width="40px" height="30px"
                                                                            class="ml-[15px] rounded-full"
                                                                            src="img/profileExample.jpg">
                                                                        <p
                                                                            class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                                            {{$bibliotekar->name}}
                                                                        </p>
                                                                    </li>
                                                                @endforeach
                                                            </div>
                                                        </ul>
                                                        <div class="flex pt-[10px] text-white ">
                                                            <button 
                                                                class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                                            </button>
                                                            <a id="bibliotekariFilterPonisti"
                                                                class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="px-4 py-4"> </th>
                                            </tr>
                                        </form>
                                    </thead>
                                    <tbody class="bg-white">
                                    @foreach($vracene as $vracena)
                                        <tr class="hover:bg-gray-200 hover:shadow-md border-b-[1px] border-[#e4dfdf]">
                                            <td class="px-4 py-3 whitespace-no-wrap">
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" class="form-checkbox">
                                                </label>
                                            </td>
                                            <td class="flex flex-row items-center px-4 py-3">
                                                <img class="object-cover w-8 mr-2 h-11" src="img/tomsojer.jpg" alt="" />
                                                <a href="{{route('izdavanjeDetalji', ['knjiga' => $vracena->book, 'ucenik' => $vracena->student])}}">
                                                    <span class="font-medium text-center">{{$vracena->book->title}}</span>
                                                </a>
                                            </td>
                                            <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                                <a href="{{route('ucenikProfile', ['ucenik' => $vracena->student])}}">
                                                    {{$vracena->student->name}}
                                                </a>
                                            </td>
                                            <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">{{$vracena->rent_date}}</td>
                                            <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">{{$vracena->rentStatus[0]->date}}</td>
                                            <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                                <div>
                                                    <span>{{ \Carbon\Carbon::parse($vracena->rent_date)->diffAsCarbonInterval($vracena->return_date) }}</span>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                                <a href="{{route('bibliotekarProfile', ['bibliotekar' => $vracena->librarian])}}">
                                                    {{$vracena->librarian->name}}
                                                </a>
                                            </td>
                                            <td class="px-6 py-3 text-sm leading-5 text-right whitespace-no-wrap">
                                                <p
                                                    class="inline cursor-pointer text-[20px] py-[10px] px-[30px] border-gray-300 dotsVraceneKnjige hover:text-[#606FC7]">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </p>
                                                <div
                                                    class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 vracene-knjige">
                                                    <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                                        aria-labelledby="headlessui-menu-button-1"
                                                        id="headlessui-menu-items-117" role="menu">
                                                        <div class="py-1">
                                                            <a href="{{route('izdavanjeDetalji', ['knjiga' => $vracena->book, 'ucenik' => $vracena->student])}}" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i class="far fa-file mr-[10px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Pogledaj detalje</span>
                                                            </a>

                                                            <a href="{{route('izdajKnjigu', ['knjiga' => $vracena->book->id])}}" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i class="far fa-hand-scissors mr-[10px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Izdaj knjigu</span>
                                                            </a>

                                                            <a href="vratiKnjigu.php" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i class="fas fa-redo-alt mr-[10px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Vrati knjigu</span>
                                                            </a>

                                                            <a href="{{route('rezervisiKnjigu', ['knjiga' => $vracena->book->id])}}" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i
                                                                    class="far fa-calendar-check mr-[10px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Rezervisi knjigu</span>
                                                            </a>

                                                            <a href="otpisiKnjigu.php" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i class="fas fa-level-up-alt mr-[14px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Otpisi knjigu</span>
                                                            </a>

                                                            <a href="{{route('izbrisiKnjigu', ['knjiga' => $vracena->book->id])}}" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i class="fa fa-trash mr-[10px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Izbrisi knjigu</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$vracene->links()}}
                            @else
                                <div class="flex items-center px-6 py-4 my-4 text-lg bg-red-200 rounded-lg">
                                    <svg viewBox="0 0 24 24" class="w-5 h-5 mr-3 text-red-600 sm:w-5 sm:h-5">
                                        <path fill="currentColor"
                                            d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z">
                                        </path>
                                    </svg>
                                    <p class="font-medium text-red-600"> Nisu pronadjeni trazeni rezultati! </p>
                                </div>
                                <div>
                                    <a class="text-blue-500" href="{{route('izdateKnjige')}}">
                                        &#8592; Back 
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </section>
        @endsection
