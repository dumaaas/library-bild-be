@extends('layouts.layout')

@section('bibliotekarProfile')
    @can('isAdmin')
        <section class="w-screen h-screen pl-[80px] pb-2 text-gray-700">
        <!-- Heading of content -->
        <div class="heading">
            <div class="flex flex-row justify-between border-b-[1px] border-[#e4dfdf]">
                <div class="pl-[30px] py-[10px] flex flex-col">
                    <div>
                        <h1>
                            {{$bibliotekar -> name}}
                        </h1>
                    </div>
                    <div>
                        <nav class="w-full rounded">
                            <ol class="flex list-reset">
                                <li>
                                    <a href="../bibliotekari" class="text-[#2196f3] hover:text-blue-600">
                                        Svi bibliotekari
                                    </a>
                                </li>
                                <li>
                                    <span class="mx-2">/</span>
                                </li>
                                <li>
                                    <a href="bibliotekarProfile" class="text-[#2196f3] hover:text-blue-600">
                                        ID-{{$bibliotekar -> id}}
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="pt-[24px] pr-[30px]">
                    <a href="#" class="inline hover:text-blue-600 show-modal">
                        <i class="fas fa-redo-alt mr-[3px]"></i>
                        Resetuj sifru
                    </a>
                    <a href="{{ route('editBibliotekar', ['bibliotekar' => $bibliotekar->id]) }}" class="hover:text-blue-600 inline ml-[20px] pr-[10px]">
                        <i class="fas fa-edit mr-[3px] "></i>
                        Izmjeni podatke
                    </a>
                    <p class="inline cursor-pointer text-[25px] py-[10px] pl-[30px] border-l-[1px] border-gray-300 dotsLibrarianProfile hover:text-[#606FC7]"
                       id="dropdownStudent">
                        <i
                            class="fas fa-ellipsis-v"></i>
                    </p>
                    <div
                        class="z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 dropdown-librarian-profile">
                        <div class="absolute right-0 w-56 mt-[10px] origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                             aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                            <div class="py-1">
                                <a href="{{ route('deleteBibliotekar', ['bibliotekar' => $bibliotekar->id]) }}" tabindex="0"
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
        <!-- Space for content -->
        <div class="pl-[30px] height-profile pb-[30px] scroll mt-[20px]">
            <div class="flex flex-row">
                <div class="mr-[30px]">
                    <div class="mt-[20px]">
                        <span class="text-gray-500">Ime i prezime</span>
                        <p class="font-medium">{{$bibliotekar -> name}}</p>
                    </div>
                    <div class="mt-[40px]">
                        <span class="text-gray-500">Tip korisnika</span>
                        <p class="font-medium">{{$bibliotekar -> userType -> name}}</p>
                    </div>
                    <div class="mt-[40px]">
                        <span class="text-gray-500">JMBG</span>
                        <p class="font-medium">{{$bibliotekar -> jmbg}}</p>
                    </div>
                    <div class="mt-[40px]">
                        <span class="text-gray-500">Email</span>
                        <a
                            class="cursor-pointer block font-medium text-[#2196f3] hover:text-blue-600">{{$bibliotekar -> email}}</a>
                    </div>
                    <div class="mt-[40px]">
                        <span class="text-gray-500">Korisnicko ime</span>
                        <p class="font-medium">{{$bibliotekar -> username}}</p>
                    </div>
                    <div class="mt-[40px]">
                        <span class="text-gray-500">Broj logovanja</span>
                        <p class="font-medium">30</p>
                    </div>
                    <div class="mt-[40px]">
                        <span class="text-gray-500">Poslednji put logovan/a</span>
                        <p class="font-medium">{{$bibliotekar -> updated_at}}</p>
                    </div>
                </div>
                <div class="ml-[100px]  mt-[20px]">
                    <img class="p-2 border-2 border-gray-300" width="300px" src="../img/{{$bibliotekar -> photo}}" alt="">
                </div>
            </div>
        </div>
    </section>
    @elsecan('isLibrarian', 'isStudent')
        <div class="pl-[110px] section- mt-[35px]">
            <div class="flex items-center px-6 py-4 my-4 text-lg bg-red-200 rounded-lg">
                <svg viewBox="0 0 24 24" class="w-5 h-5 mr-3 text-red-600 sm:w-5 sm:h-5">
                    <path fill="currentColor"
                          d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z">
                    </path>
                </svg>
                <p class="font-medium text-red-600"> Niste autorizovani da otvorite ovu stranicu! </p>
            </div>
        </div>
    @endcan
@endsection
