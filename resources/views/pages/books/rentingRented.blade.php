@extends('layouts.book')
@section('rentedRenting')
    <div class="w-[80%]">
        <div class="border-b-[1px] border-[#e4dfdf] py-4 pl-[30px]">
            <a href="{{route('bookDetails', ['book' => $book])}}" class="inline hover:text-blue-800">
                Osnovni detalji
            </a>
            <a href="{{route('bookSpecification', ['book' => $book])}}" class="inline ml-[70px] hover:text-blue-800">
                Specifikacija
            </a>
            <a href="{{route('rentingRented', ['book' => $book])}}" class="inline ml-[70px] active-book-nav hover:text-blue-800">
                Evidencija iznajmljivanja
            </a>
            <a href="{{route('bookMultimedia', ['book' => $book])}}" class="inline ml-[70px] hover:text-blue-800">
                Multimedija
            </a>
        </div>
        <div class="py-4 pt-[20px] pl-[30px] text-[#2D3B48]">
            <a href="{{route('rentingRented', ['book' => $book])}}"
               class="py-[15px] px-[20px] w-[268px] text-[#576cdf] cursor-pointer bg-[#EFF3F6] rounded-[10px] inline hover:text-[#576cdf]">
                <i class="text-[20px] far fa-copy mr-[3px]"></i>
                Izdate knjige
            </a>
            <a href="{{route('rentingReturned', ['book' => $book])}}"
               class="inline py-[15px] rounded-[10px] group px-[20px] w-[268px] hover:text-[#576cdf] hover:bg-[#EFF3F6] ml-[20px] pr-[10px]">
                <i class="text-[20px] text-[#707070] group-hover:text-[#576cdf] fas fa-file mr-[3px]"></i>
                Vraćene knjige
            </a>
            <a href="{{route('rentingOverdue', ['book' => $book])}}"
               class="inline py-[15px] rounded-[10px] group px-[20px] w-[268px] hover:text-[#576cdf] hover:bg-[#EFF3F6] mx-[20px] pr-[10px]">
                <i class="text-[20px] text-[#707070] group-hover:text-[#576cdf] fas fa-exclamation-triangle mr-[3px]"></i>
                Knjige u prekoračenju
            </a>
            <a class="border-r-[1px] py-[10px] border-[#e4dfdf]"></a>
            <a href="{{route('rentingActive', ['book' => $book])}}"
               class="inline py-[15px] rounded-[10px] group px-[20px] w-[268px] hover:text-[#576cdf] hover:bg-[#EFF3F6] ml-[20px] pr-[10px]">
                <i class="text-[20px] text-[#707070] group-hover:text-[#576cdf] far fa-calendar-check mr-[3px]"></i>
                Aktivne rezervacije
            </a>
            <a href="{{route('rentingArchived', ['book' => $book])}}"
               class="inline py-[15px] rounded-[10px] group px-[20px] w-[268px] hover:text-[#576cdf] hover:bg-[#EFF3F6] ml-[20px] pr-[10px]">
                <i class="text-[20px] text-[#707070] group-hover:text-[#576cdf] fas fa-calendar-alt  mr-[3px]"></i>
                Arhivirane rezervacije
            </a>
        </div>
        <!-- Space for content -->
        @if(count($rentingRented) > 0)
            <div class="w-full mt-[10px] ml-2 px-4">
                <table class="w-full shadow-lg" id="myTable">
                    <thead class="bg-[#EFF3F6]">
                    <tr class="border-b-[1px] border-[#e4dfdf]">
                        <th class="p-4 leading-4 tracking-wider text-left text-blue-500">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox">
                            </label>
                        </th>
                        <th class="relative p-4 text-sm leading-4 tracking-wider text-left cursor-pointer whitespace-nowrap">Izdato učeniku<i class="ml-2 fas fa-filter studentsDrop-toggle"></i>
                            <div id="studentsDropdown"
                                class="studentsMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] pin-t pin-l border-2 border-gray-300">
                                <ul class="border-b-2 border-gray-300 list-reset">
                                    <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                        <input
                                            class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                            placeholder="Search"
                                            onkeyup="filterFunction('searchStudents', 'studentsDropdown', 'dropdown-item-student')"
                                            id="searchStudents"><br>
                                        <button
                                            class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </li>
                                    <div class="h-[200px] scroll font-normal">
                                        <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-student">
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
                                            <img width="40px" height="30px"
                                                class="ml-[15px] rounded-full"
                                                src="img/profileStudent.jpg">
                                            <p
                                                class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                Učenik Učeniković
                                            </p>
                                        </li>
                                        <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-student">
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
                                            <img width="40px" height="30px"
                                                class="ml-[15px] rounded-full"
                                                src="img/profileStudent.jpg">
                                            <p
                                                class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                Pero Perović
                                            </p>
                                        </li>
                                        <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-student">
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
                                            <img width="40px" height="30px"
                                                class="ml-[15px] rounded-full"
                                                src="img/profileStudent.jpg">
                                            <p
                                                class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                Marko Marković
                                            </p>
                                        </li>
                                        <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-student">
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
                                            <img width="40px" height="30px"
                                                class="ml-[15px] rounded-full"
                                                src="img/profileStudent.jpg">
                                            <p
                                                class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                Nikola Nikolić
                                            </p>
                                        </li>
                                        <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-student">
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
                                            <img width="40px" height="30px"
                                                class="ml-[15px] rounded-full"
                                                src="img/profileStudent.jpg">
                                            <p
                                                class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                Živko Živković
                                            </p>
                                        </li>
                                        <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-student">
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
                                            <img width="40px" height="30px"
                                                class="ml-[15px] rounded-full"
                                                src="img/profileStudent.jpg">
                                            <p
                                                class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                Petar Petrović
                                            </p>
                                        </li>
                                    </div>
                                </ul>
                                <div class="flex pt-[10px] text-white ">
                                    <a href="#"
                                    class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                    <i class="fas fa-check mr-[7px]"></i> Sačuvaj 
                                    </a>
                                    <a href="#"
                                    class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                    <i class="fas fa-times mr-[7px]"></i> Poništi 
                                    </a>
                                </div>
                            </div></th>
                        <th class="relative p-4 text-sm leading-4 tracking-wider text-left cursor-pointer whitespace-nowrap">Datum izdavanja<i class="fas fa-filter dateDrop-toggle"></i>
                            <div id="dateDropdown"
                                class="dateMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] pin-l border-2 border-gray-300">
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
                                    <i class="fas fa-check mr-[7px]"></i> Sačuvaj 
                                    </a>
                                    <a href="#"
                                    class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                    <i class="fas fa-times mr-[7px]"></i> Poništi 
                                    </a>
                                </div>
                            </div>
                        </th>
                        <th class="relative p-4 text-sm leading-4 tracking-wider text-left cursor-pointer whitespace-nowrap">Trenutno
                            zadržavanje knjige <i class="fas fa-filter delayDrop-toggle"></i>
                            <div id="delayDropdown"
                                class="delayMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] right-0 border-2 border-gray-300">
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
                                    <i class="fas fa-check mr-[7px]"></i> Sačuvaj 
                                    </a>
                                    <a href="#"
                                    class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                    <i class="fas fa-times mr-[7px]"></i> Poništi 
                                    </a>
                                </div>
                            </div></th>
                        <th class="relative p-4 text-sm leading-4 tracking-wider text-left cursor-pointer whitespace-nowrap">Knjigu izdao<i class="fas fa-filter librariansDrop-toggle"></i>
                            <div id="librariansDropdown"
                                class="librariansMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] right-0 border-2 border-gray-300">
                                <ul class="border-b-2 border-gray-300 list-reset">
                                    <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                        <input
                                            class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                            placeholder="Search"
                                            onkeyup="filterFunction('searchLibrarians', 'librariansDropdown', 'dropdown-item-librarian')"
                                            id="searchLibrarians"><br>
                                        <button
                                            class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </li>
                                    <div class="h-[200px] scroll font-normal">
                                        <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-librarian">
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
                                            <img width="40px" height="30px"
                                                class="ml-[15px] rounded-full"
                                                src="img/profileExample.jpg">
                                            <p
                                                class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                Bibliotekar Bulatović
                                            </p>
                                        </li>
                                        <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-librarian">
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
                                            <img width="40px" height="30px"
                                                class="ml-[15px] rounded-full"
                                                src="img/profileExample.jpg">
                                            <p
                                                class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                Pero Perović
                                            </p>
                                        </li>
                                        <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-librarian">
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
                                            <img width="40px" height="30px"
                                                class="ml-[15px] rounded-full"
                                                src="img/profileExample.jpg">
                                            <p
                                                class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                Marko Marković
                                            </p>
                                        </li>
                                        <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-librarian">
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
                                            <img width="40px" height="30px"
                                                class="ml-[15px] rounded-full"
                                                src="img/profileExample.jpg">
                                            <p
                                                class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                Nikola Nikolić
                                            </p>
                                        </li>
                                        <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-librarian">
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
                                            <img width="40px" height="30px"
                                                class="ml-[15px] rounded-full"
                                                src="img/profileExample.jpg">
                                            <p
                                                class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                Živko Živković
                                            </p>
                                        </li>
                                        <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-librarian">
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
                                            <img width="40px" height="30px"
                                                class="ml-[15px] rounded-full"
                                                src="img/profileExample.jpg">
                                            <p
                                                class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                Petar Petrović
                                            </p>
                                        </li>
                                    </div>
                                </ul>
                                <div class="flex pt-[10px] text-white ">
                                    <a href="#"
                                    class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                    <i class="fas fa-check mr-[7px]"></i> Sačuvaj 
                                    </a>
                                    <a href="#"
                                    class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                    <i class="fas fa-times mr-[7px]"></i> Poništi 
                                    </a>
                                </div>
                            </div></th>
                        <th class="p-4"> </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    @foreach($rentingRented as $rentingRent)
                    <tr class="hover:bg-gray-200 hover:shadow-md border-b-[1px] border-[#e4dfdf]">
                        <td class="p-4 whitespace-nowrap">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox">
                            </label>
                        </td>
                        <td class="p-4 text-sm leading-5 truncate max-w-[100px]">{{$rentingRent->student->name}}</td>
                        <td class="p-4 text-sm leading-5 truncate max-w-[100px]">{{$rentingRent->rentStatus[0]->date}}</td>
                        <td class="p-4 text-sm leading-5 truncate max-w-[200px]">
                            <div>
                                <span>{{ \Carbon\Carbon::parse($rentingRent->rent_date)->diffAsCarbonInterval() }}</span>
                            </div>
                        </td>
                        <td class="p-4 text-sm leading-5 truncate max-w-[100px]">{{$rentingRent->librarian->name}}</td>
                        <td class="p-4 text-sm leading-5 text-right whitespace-nowrap">
                            <p class="inline cursor-pointer text-[20px] py-[10px] px-[30px] border-gray-300 dotsRentingRentedBooks hover:text-[#606FC7]">
                                <i
                                    class="fas fa-ellipsis-v"></i>
                            </p>
                            <div
                                class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 renting-rented-books">
                                <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                    aria-labelledby="headlessui-menu-button-1"
                                    id="headlessui-menu-items-117" role="menu">
                                    <div class="py-1">
                                        <a href="{{route('rentDetails',['book'=>$rentingRent->book,'student'=>$rentingRent->student])}}" tabindex="0"
                                        class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                        role="menuitem">
                                            <i class="far fa-file mr-[10px] ml-[5px] py-1"></i>
                                            <span class="px-4 py-0">Pogledaj detalje</span>
                                        </a>

                                        <a href="{{route('writeOffBook',['book'=>$rentingRent->book])}}" tabindex="0"
                                        class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                        role="menuitem">
                                            <i class="fas fa-level-up-alt mr-[14px] ml-[5px] py-1"></i>
                                            <span class="px-4 py-0">Otpiši knjigu</span>
                                        </a>

                                        <a href="{{route('returnBook',['book'=>$rentingRent->book])}}" tabindex="0"
                                        class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                        role="menuitem">
                                            <i class="fas fa-redo-alt mr-[10px] ml-[5px] py-1"></i>
                                            <span class="px-4 py-0">Vrati knjigu</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                {{$rentingRented->links()}}
                
            </div>
        @else
            <div class="mx-[40px] flex items-center px-6 py-4 my-4 text-lg bg-red-200 rounded-lg">
                <svg viewBox="0 0 24 24" class="w-5 h-5 mr-3 text-red-600 sm:w-5 sm:h-5">
                    <path fill="currentColor"
                        d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z">
                    </path>
                </svg>
                <p class="font-medium text-red-600"> Knjiga {{$book->title}} nema izdatih primjeraka! </p>
            </div>
        @endif
            <!--Modal-->
            <div
                class="absolute z-20 top-0 left-0 items-center justify-center hidden w-full h-screen bg-black bg-opacity-10 delete-modal_{{$book->id}}" id="{{$book->id}}">
                <!-- Modal -->
                <div class="w-[500px] bg-white rounded shadow-lg md:w-1/3">
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between px-[30px] py-[20px] border-b">
                        <h3>Da li ste sigurni da želite da izbrišete knjigu?</h3>
                        <button class="text-black close cancel focus:outline-none" id="{{$book->id}}">
                            <span aria-hidden="true" class="text-[30px]">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Body -->
                    <div class="flex items-center justify-center px-[30px] py-[20px] border-t w-100 text-white">
                        <a href="{{route('deleteBook', ['book' => $book->id])}}"
                            class=" text-center shadow-lg mr-[15px] w-[150px] focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                            <i class="fas fa-check mr-[7px]"></i> Izbriši
                        </a>
                        <a href="#" id="{{$book->id}}" class="cancel shadow-lg w-[150px] focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] bg-[#F44336] hover:bg-[#F55549] text-center">
                        <i class="fas fa-times mr-[7px]"></i> Poništi 
                        </a>
                    </div>
                </div>
            </div>
    </div>
@endsection
