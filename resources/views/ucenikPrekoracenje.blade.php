@extends('layouts.layout')

@section('ucenikPrekoracenje')
<section class="w-screen h-screen pl-[80px] pb-4 text-gray-700">
            <!-- Heading of content -->
            <div class="heading">
                <div class="flex flex-row justify-between border-b-[1px] border-[#e4dfdf]">
                    <div class="pl-[30px] py-[10px] flex flex-col">
                        <div>
                            <h1>
                                Pero Perovic
                            </h1>
                        </div>
                        <div>
                            <nav class="w-full rounded">
                                <ol class="flex list-reset">
                                    <li>
                                        <a href="ucenik.php" class="text-[#2196f3] hover:text-blue-600">
                                            Svi ucenici
                                        </a>
                                    </li>
                                    <li>
                                        <span class="mx-2">/</span>
                                    </li>
                                    <li>
                                        <a href="ucenikProfile.php" class="text-[#2196f3] hover:text-blue-600">
                                            ID-354
                                        </a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="pt-[24px] pr-[30px]">
                        <a href="#" class="inline hover:text-blue-600">
                            <i class="fas fa-redo-alt mr-[3px]"></i>
                            Resetuj sifru
                        </a>
                        <a href="editUcenik.php" class="hover:text-blue-600 inline ml-[20px] pr-[10px]">
                            <i class="fas fa-edit mr-[3px] "></i>
                            Izmjeni podatke
                        </a>
                        <p
                            class="inline cursor-pointer text-[25px] py-[10px] pl-[30px] border-l-[1px] border-gray-300 dotsUcenikKnjigePrekoracenje hover:text-[#606FC7]">
                            <i class="fas fa-ellipsis-v"></i>
                        </p>
                        <div
                            class="z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 ucenik-prekoracenje-knjige">
                            <div class="absolute right-0 w-56 mt-[10px] origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                                <div class="py-1">
                                    <a href="#" tabindex="0"
                                        class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                        role="menuitem">
                                        <i class="fa fa-trash mr-[5px] ml-[5px] py-1"></i>
                                        <span class="px-4 py-0">Izbrisi korisnika</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-b-[1px] py-4 text-gray-500 border-[#e4dfdf] pl-[30px]">
                <a href="ucenikProfile.php" class="inline hover:text-blue-800">
                    Osnovni detalji
                </a>
                <a href="ucenikIzdate.php" class="inline ml-[70px] active-book-nav">
                    Evidencija iznajmljivanja
                </a>
            </div>
            <!-- Space for content -->
            <div class="flex justify-start pt-3 bg-white height-ucenikIzdate scroll">
                <div class="mt-[10px]">
                    <ul class="text-[#2D3B48]">
                        <li class="mb-[4px]">
                            <div class="w-[300px] pl-[32px]">
                                <span class=" whitespace-nowrap w-full text-[25px]  flex justify-between fill-current">
                                    <div
                                        class="py-[15px] px-[20px] w-[268px] cursor-pointer group hover:bg-[#EFF3F6] rounded-[10px]">
                                        <a href="{{route('ucenikIzdate', ['ucenik' => $ucenik])}}" aria-label="Sve knjige" class="flex items-center">
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
                                <span class=" whitespace-nowrap w-full text-[25px] flex justify-between fill-current">
                                    <div
                                        class="group hover:bg-[#EFF3F6] py-[15px] px-[20px] w-[268px] rounded-[10px] cursor-pointer">
                                        <a href="{{route('ucenikVracene', ['ucenik' => $ucenik])}}" aria-label="Vracene knjige"
                                            class="flex items-center">
                                            <i
                                                class="transition duration-300 ease-in  text-[#707070] text-[20px] fas fa-file group-hover:text-[#576cdf]"></i>
                                            <div>
                                                <p
                                                    class="transition duration-300 ease-in  text-[15px] ml-[21px] group-hover:text-[#576cdf]">
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
                                <span class=" whitespace-nowrap w-full text-[25px] flex justify-between fill-current">
                                    <div
                                        class="group bg-[#EFF3F6] hover:bg-[#EFF3F6] py-[15px] px-[20px] w-[268px] rounded-[10px] cursor-pointer">
                                        <a href="{{route('ucenikPrekoracenje', ['ucenik' => $ucenik])}}" aria-label="Knjige na raspolaganju"
                                            class="flex items-center">
                                            <i
                                                class="text-[#576cdf] text-[20px] fas fa-exclamation-triangle transition duration-300 ease-in "></i>
                                            <div>
                                                <p
                                                    class="text-[15px] ml-[17px] transition duration-300 ease-in text-[#576cdf]">
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
                                        <a href="{{route('ucenikAktivne', ['ucenik' => $ucenik])}}" aria-label="Rezervacije" class="flex items-center">
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
                                <span class=" whitespace-nowrap w-full text-[25px] flex justify-between fill-current">
                                    <div
                                        class="group hover:bg-[#EFF3F6] py-[15px] px-[20px] w-[268px] rounded-[10px] cursor-pointer">
                                        <a href="{{route('ucenikArhivirane', ['ucenik' => $ucenik])}}" aria-label="Rezervacije"
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
                    <table class="w-full shadow-lg" id="myTable">
                        <thead class="bg-[#EFF3F6]">
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
                                <th
                                    class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer">
                                    Datum izdavanja<i class="ml-2 fas fa-filter datumDrop-toggle"></i>
                                    <div id="datumDropdown"
                                        class="datumMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] pin-l border-2 border-gray-300">
                                        <div
                                            class="flex justify-between flex-row p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                            <div>
                                                <label class="font-medium text-gray-500">Period od:</label>
                                                <input type="date"
                                                    class="border-[1px] border-[#e4dfdf]  cursor-pointer focus:outline-none">
                                            </div>
                                            <div class="ml-[50px]">
                                                <label class="font-medium text-gray-500">Period do:</label>
                                                <input type="date"
                                                    class="border-[1px] border-[#e4dfdf]  cursor-pointer focus:outline-none">
                                            </div>
                                        </div>
                                        <div class="flex pt-[10px] text-white ">
                                            <a href="#"
                                                class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                            </a>
                                            <a href="#"
                                                class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                                            </a>
                                        </div>
                                    </div>
                                </th>
                                <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Prekoracenje u danima
                                </th>
                                <th
                                    class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer">
                                    Trenutno zadrzavanje knjige<i class="fas fa-filter zadrzavanjeDrop-toggle"></i>
                                    <div id="zadrzavanjeDropdown"
                                        class="zadrzavanjeMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] right-0 border-2 border-gray-300">
                                        <div
                                            class="flex justify-between flex-row p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                            <div>
                                                <label class="font-medium text-gray-500">Period od:</label>
                                                <input type="date"
                                                    class="border-[1px] border-[#e4dfdf]  cursor-pointer focus:outline-none">
                                            </div>
                                            <div class="ml-[50px]">
                                                <label class="font-medium text-gray-500">Period do:</label>
                                                <input type="date"
                                                    class="border-[1px] border-[#e4dfdf]  cursor-pointer focus:outline-none">
                                            </div>
                                        </div>
                                        <div class="flex pt-[10px] text-white ">
                                            <a href="#"
                                                class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                            </a>
                                            <a href="#"
                                                class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                                            </a>
                                        </div>
                                    </div>
                                </th>
                                <th class="px-4 py-4"> </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                        @foreach($ucenikPrekoracene as $ucenikPrekoracena)
                            <tr class="hover:bg-gray-200 hover:shadow-md border-b-[1px] border-[#e4dfdf]">
                                <td class="px-4 py-3 whitespace-no-wrap">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox">
                                    </label>
                                </td>
                                <td class="flex flex-row items-center px-4 py-3">
                                    <img class="object-cover w-8 mr-2 h-11" src="img/tomsojer.jpg" alt="" />
                                    <a href="izdavanjeDetalji.php">
                                        <span class="font-medium text-center">{{$ucenikPrekoracena->book->title}}</span>
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">{{$ucenikPrekoracena->rent_date}}</td>
                                <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                    <div class="inline-block px-[6px] py-[2px] font-medium bg-red-200 rounded-[10px]">
                                        <span class="text-xs text-red-800">60 dana</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                    <div>
                                        <span>{{ \Carbon\Carbon::parse($ucenikPrekoracena->rent_date)->diffAsCarbonInterval() }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-sm leading-5 text-right whitespace-no-wrap">
                                    <p
                                        class="inline cursor-pointer text-[20px] py-[10px] px-[30px] border-gray-300 dotsUcenikPrekoracenjeKnjige hover:text-[#606FC7]">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </p>
                                    <div
                                        class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 ucenik-prekoracenje-knjige-tabela">
                                        <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                            aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117"
                                            role="menu">
                                            <div class="py-1">
                                                <a href="izdavanjeDetalji.php" tabindex="0"
                                                    class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                    role="menuitem">
                                                    <i class="far fa-file mr-[10px] ml-[5px] py-1"></i>
                                                    <span class="px-4 py-0">Pogledaj detalje</span>
                                                </a>

                                                <a href="editKnjiga.php" tabindex="0"
                                                    class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                    role="menuitem">
                                                    <i class="fas fa-edit mr-[6px] ml-[5px] py-1"></i>
                                                    <span class="px-4 py-0">Izmijeni knjigu</span>
                                                </a>

                                                <a href="izdajKnjigu.php" tabindex="0"
                                                    class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                    role="menuitem">
                                                    <i class="far fa-hand-scissors mr-[10px] ml-[5px] py-1"></i>
                                                    <span class="px-4 py-0">Izdaj knjigu</span>
                                                </a>

                                                <a href="rezervisiKnjigu.php" tabindex="0"
                                                    class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                    role="menuitem">
                                                    <i class="far fa-calendar-check mr-[10px] ml-[5px] py-1"></i>
                                                    <span class="px-4 py-0">Rezervisi knjigu</span>
                                                </a>

                                                <a href="vratiKnjigu.php" tabindex="0"
                                                    class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                    role="menuitem">
                                                    <i class="fas fa-redo-alt mr-[10px] ml-[5px] py-1"></i>
                                                    <span class="px-4 py-0">Vrati knjigu</span>
                                                </a>

                                                <a href="otpisiKnjigu.php" tabindex="0"
                                                    class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                    role="menuitem">
                                                    <i class="fas fa-level-up-alt mr-[14px] ml-[5px] py-1"></i>
                                                    <span class="px-4 py-0">Otpisi knjigu</span>
                                                </a>

                                                <a href="#" tabindex="0"
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
                    <div class="pt-[20px]">
                    {{$ucenikPrekoracene->links()}}
                    </div>
                </div>
            </div>
        </section>
        @endsection