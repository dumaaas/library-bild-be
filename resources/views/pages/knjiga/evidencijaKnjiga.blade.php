@extends('layouts.layout')
@section('evidencijaKnjiga')
    <section class="w-screen h-screen pl-[80px] py-4 text-gray-700">
        <!-- Heading of content -->
        <div class="heading mt-[7px]">
            <h1 class="pl-[30px] pb-[21px] border-b-[1px] border-[#e4dfdf] ">
                Knjige
            </h1>
            @if(Session::has('success'))
                <div class="fadeInOut absolute top-[91px] py-[15px] px-[30px] rounded-[15px] text-white bg-[#4CAF50] right-[20px]">
                    <i class="fa fa-check mr-[5px]" aria-hidden="true"></i> {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                </div>
            @endif
        </div>
        <!-- Space for content -->
        @if(count($knjige) > 0)
            <div class="scroll height-evidencija">
                <div class="flex items-center justify-between px-[30px] py-4 space-x-3 rounded-lg">
                    <a href="{{route('novaKnjiga')}}"
                    class="btn-animation inline-flex items-center text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] tracking-wider text-white bg-[#3f51b5] hover:bg-[#4558BE]">
                        <i class="fas fa-plus mr-[15px]"></i> Nova knjiga
                    </a>
                    <form action="searchKnjige" method="GET">
                        <div class="flex items-center px-6 py-4 space-x-3 rounded-lg ml-[292px]">
                            <div class="flex items-center">
                                <div class="relative text-gray-600 focus-within:text-gray-400">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                            <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
                                                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                </svg>
                                            </button>
                                        </span>
                                    <input type="search" name="searchKnjige"
                                        class="py-2 pl-10 text-sm text-white bg-white rounded-md focus:outline-none focus:bg-white focus:text-gray-900"
                                        placeholder="Search..." autocomplete="off">
                                </div>
                            </div>
                            <button
                                class="btn-animation inline-flex items-center text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] tracking-wider text-white bg-[#3f51b5] hover:bg-[#4558BE]">Pretrazi
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Space for content -->
                <div class="px-[30px] pt-2 bg-white">
                    <div class="w-full mt-2">
                        <!-- Table -->
                        @if(count($knjige) > 0)
                        <table class="w-full shadow-lg" id="myTable">
                            <!-- Table head-->
                            <thead class="bg-[#EFF3F6]">
                                <tr class="border-b-[1px] border-[#e4dfdf]">
                                        <th class="px-4 py-4 leading-4 tracking-wider text-left text-blue-500">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" class="form-checkbox checkAll">
                                            </label>
                                        </th>
                                        <th class="flex items-center px-4 py-4 leading-4 tracking-wider text-left">
                                            Naziv knjige
                                            <a href="#"><i class="ml-2 fa-lg fas fa-long-arrow-alt-down"
                                                        onclick="sortTable()"></i>
                                            </a>
                                        </th>

                                            <!-- Autor + dropdown filter for autor -->
                                            <form action='/filterAutori' method="GET">
                                                <th
                                                    class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer ">
                                                        Autor<i class="ml-2 fas fa-filter" id="autoriMenu"></i>
                                                        <div id="autoriDropdown"
                                                            class="autoriMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] pin-t pin-l border-2 border-gray-300">
                                                            <ul class="border-b-2 border-gray-300 list-reset">
                                                                <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                                    <input class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                                                        placeholder="Search"
                                                                        onkeyup="filterFunction('searchAutori', 'autoriDropdown')"
                                                                        id="searchAutori"><br>
                                                                    <button
                                                                        class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                                                        <i class="fas fa-search"></i>
                                                                    </button>
                                                                </li>
                                                                <div class="h-[200px] scroll font-normal">
                                                                    @foreach($autori as $autor)
                                                                        <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                                            <label class="flex items-center justify-start">
                                                                                <div
                                                                                    class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                                                    <input type="checkbox" class="absolute opacity-0 autoriFilterPonisti" name="autoriFilter[]" value="{{$autor->id}}">
                                                                                    <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                                        viewBox="0 0 20 20">
                                                                                        <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                                                    </svg>
                                                                                </div>
                                                                            </label>
                                                                            <p
                                                                                class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                                                {{$autor->name}}
                                                                            </p>
                                                                        </li>
                                                                    @endforeach
                                                                </div>
                                                            </ul>
                                                            <div class="flex pt-[10px] text-white ">
                                                                <button href="#"
                                                                class="py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                                    Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                                                </button>
                                                                <button type="reset" id="autoriFilterPonisti"
                                                                class="ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                                    Ponisti <i class="fas fa-times ml-[4px]"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                </th>

                                                <!-- Kategorija + dropdown filter for kategorija -->
                                                <th class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer">
                                                        Kategorija<i class="ml-2 fas fa-filter" id="kategorijeMenu"></i>
                                                        <div id="kategorijeDropdown"
                                                            class="kategorijeMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] pin-t pin-l border-2 border-gray-300">
                                                            <ul class="border-b-2 border-gray-300 list-reset">
                                                                <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                                    <input class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                                                        placeholder="Search"
                                                                        onkeyup="filterFunction('searchKategorije', 'kategorijeDropdown')"
                                                                        id="searchKategorije"><br>
                                                                    <button
                                                                        class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                                                        <i class="fas fa-search"></i>
                                                                    </button>
                                                                </li>
                                                                <div class="h-[200px] scroll font-normal">
                                                                    @foreach($kategorije as $kategorija)
                                                                        <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                                            <label class="flex items-center justify-start">
                                                                                <div
                                                                                    class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                                                    <input type="checkbox" class="absolute opacity-0 kategorijaFilterPonisti" name="kategorijeFilter[]" value="{{$kategorija->id}}">
                                                                                    <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                                        viewBox="0 0 20 20">
                                                                                        <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                                                    </svg>
                                                                                </div>
                                                                            </label>
                                                                            <p
                                                                                class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                                                {{$kategorija->name}}
                                                                            </p>
                                                                        </li>
                                                                    @endforeach
                                                                </div>
                                                            </ul>
                                                            <div class="flex pt-[10px] text-white ">
                                                                <button href="#"
                                                                class="py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                                    Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                                                </button>
                                                                <button type="reset"
                                                                class="ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                                    Ponisti <i class="fas fa-times ml-[4px]"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                </th>
                                            </form>
                                            <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Na raspolaganju
                                            </th>
                                            <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Rezervisano</th>
                                            <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Izdato</th>
                                            <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">U prekoracenju</th>
                                            <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Ukupna kolicina
                                            </th>
                                            <th class="px-4 py-4"> </th>
                                        </tr>

                                </thead>
                                <tbody class="bg-white" id="bookTable">
                                    @foreach($knjige as $knjiga)
                                            <tr class="hover:bg-gray-200 hover:shadow-md border-b-[1px] border-[#e4dfdf]">
                                                <td class="px-4 py-4 whitespace-no-wrap">
                                                    <label class="inline-flex items-center">
                                                        <input type="checkbox" class="form-checkbox checkOthers">
                                                    </label>
                                                </td>
                                                <td class="flex flex-row items-center px-4 py-4">
                                                    @if(count($knjiga->coverImage) > 0 ) 
                                                        <img class="object-cover w-8 mr-2 h-11" src="/storage/image/{{$knjiga->coverImage[0]->photo}}" alt="" />
                                                    @endif
                                                    <a href="{{route('knjigaOsnovniDetalji', ['knjiga' => $knjiga->id])}}">
                                                        <span class="font-medium text-center">{{$knjiga->title}}</span>
                                                    </a>
                                                </td>
                                                <td class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">
                                                    @foreach($knjiga->author as $autor)
                                                        {{ $autor->author->name }}
                                                        {{ $loop->last ? '' : ',' }}
                                                    @endforeach
                                                </td>
                                                <td class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">
                                                    @foreach($knjiga->category as $kategorija)
                                                        {{$kategorija->category->name}}
                                                        {{ $loop->last ? '' : ',' }}
                                                    @endforeach
                                                </td>
                                                <td class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">
                                                    {{$knjiga->quantity - $knjiga->reservedBooks - $knjiga->rentedBooks}}
                                                </td>
                                                <td class="px-4 py-4 text-sm leading-5 text-blue-800 whitespace-no-wrap">
                                                    <a href="{{route('iznajmljivanjeArhivirane', ['knjiga' => $knjiga->id])}}">
                                                        {{$knjiga->reservedBooks}}
                                                    </a>
                                                </td>
                                                <td class="px-4 py-4 text-sm leading-5 text-blue-800 whitespace-no-wrap">
                                                    <a href="{{route('iznajmljivanjeIzdate', ['knjiga' => $knjiga->id])}}">
                                                        {{$knjiga->rentedBooks}}
                                                    </a>
                                                </td>
                                                <td class="px-4 py-4 text-sm leading-5 text-blue-800 whitespace-no-wrap">
                                                    <a href="{{route('iznajmljivanjePrekoracenje', ['knjiga' => $knjiga->id])}}">
                                                        {{\App\Models\Rent::where('return_date', '<', Carbon\Carbon::now())->where('book_id', '=', $knjiga->id)->count()}}
                                                    </a>
                                                </td>
                                                <td class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">
                                                    {{$knjiga->quantity}}
                                                </td>
                                                <td class="px-6 py-4 text-sm leading-5 text-right whitespace-no-wrap">
                                                    <p class="inline cursor-pointer text-[20px] py-[10px] px-[30px] border-gray-300 dotsKnjige hover:text-[#606FC7]">
                                                        <i
                                                            class="fas fa-ellipsis-v"></i>
                                                    </p>
                                                    <div
                                                        class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 dropdown-knjige">
                                                        <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                                            aria-labelledby="headlessui-menu-button-1"
                                                            id="headlessui-menu-items-117" role="menu">
                                                            <div class="py-1">
                                                                <a href="{{route('knjigaOsnovniDetalji', ['knjiga' => $knjiga->id])}}" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                    <i class="far fa-file mr-[10px] ml-[5px] py-1"></i>
                                                                    <span class="px-4 py-0">Pogledaj detalje</span>
                                                                </a>

                                                                <a href="{{route('editKnjiga', ['knjiga' => $knjiga->id])}}" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                    <i class="fas fa-edit mr-[6px] ml-[5px] py-1"></i>
                                                                    <span class="px-4 py-0">Izmijeni knjigu</span>
                                                                </a>

                                                                <a href="{{route('otpisiKnjigu', ['knjiga' => $knjiga->id])}}" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                    <i class="fas fa-level-up-alt mr-[14px] ml-[5px] py-1"></i>
                                                                    <span class="px-4 py-0">Otpisi knjigu</span>
                                                                </a>

                                                                <a href="{{route('izdajKnjigu', ['knjiga' => $knjiga->id])}}" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                    <i class="far fa-hand-scissors mr-[10px] ml-[5px] py-1"></i>
                                                                    <span class="px-4 py-0">Izdaj knjigu</span>
                                                                </a>

                                                                <a href="{{route('vratiKnjigu', ['knjiga' => $knjiga->id])}}" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                    <i class="fas fa-redo-alt mr-[10px] ml-[5px] py-1"></i>
                                                                    <span class="px-4 py-0">Vrati knjigu</span>
                                                                </a>

                                                                <a href="{{route('rezervisiKnjigu', ['knjiga' => $knjiga->id])}}" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                    <i class="far fa-calendar-check mr-[10px] ml-[5px] py-1"></i>
                                                                    <span class="px-4 py-0">Rezervisi knjigu</span>
                                                                </a>

                                                                <a href="{{route('izbrisiKnjigu', ['knjiga' => $knjiga->id])}}" tabindex="0"
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
                                {{$knjige->links()}}
                            </div>
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
                                <a class="text-blue-500" href="{{route('evidencijaKnjiga')}}">
                                    &#8592; Back 
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="mx-[20px] mt-[20px]">
                    <a href="{{route('novaKnjiga')}}" class="btn-animation inline-flex items-center text-sm py-2.5 px-5 rounded-[5px] tracking-wider text-white bg-[#3f51b5] hover:bg-[#4558BE]">
                        <i class="fas fa-plus mr-[15px]"></i> Nova knjiga
                    </a>
                <div class="w-[360px] flex items-center px-6 py-4 my-4 text-lg bg-red-200 rounded-lg">                       
                    <svg viewBox="0 0 24 24" class="w-5 h-5 mr-3 text-red-600 sm:w-5 sm:h-5">
                        <path fill="currentColor"
                                d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z">
                        </path>
                    </svg>
                    <p class="font-medium text-red-600"> Ne postoji nijedna knjiga u bazi podataka </p>
                </div>
            </div>   
        @endif 
    </section>
@endsection
