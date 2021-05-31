@extends('layouts.layout')

@section('ucenik')
<section class="w-screen h-screen py-4 pl-[60px] text-[#212121]">
            <!-- Heading of content -->
            <div class="heading mt-[7px]">
                <h1 class="pl-[50px] pb-[21px]  border-b-[1px] border-[#e4dfdf] ">
                    Ucenici
                </h1>
                @if(Session::has('success'))
                    <div class="fadeInOut absolute top-[91px] py-[15px] px-[30px] rounded-[15px] text-white bg-[#4CAF50] right-[20px] fadeIn">
                    <i class="fa fa-check mr-[5px]" aria-hidden="true"></i> {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                @endif
            </div>
            <!-- Space for content -->
            @if(count($ucenici) > 0)
                <div class="scroll height-dashboard">
                    <div class="flex items-center justify-between px-[50px] py-4 space-x-3 rounded-lg">
                        <a href="{{ route('noviUcenik') }}" class="btn-animation inline-flex items-center text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] tracking-wider text-white bg-[#3f51b5] rounded hover:bg-[#4558BE]">
                            <i class="fas fa-plus mr-[15px]"></i> Novi ucenik  
                        </a>
                        <form action="searchUcenici" method="GET">
                            <div class="flex items-center px-6 py-4 space-x-3 rounded-lg ml-[292px]">
                                <div class="flex items-center">
                                    <div class="relative text-gray-600 focus-within:text-gray-400">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                            <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                            </button>
                                        </span>
                                        <input type="search" name="searchUcenici" class="py-2 pl-10 text-sm text-white bg-white rounded-md focus:outline-none focus:bg-white focus:text-gray-900" placeholder="Search..." autocomplete="off">
                                    </div>
                                </div>
                                <button
                                    class="btn-animation inline-flex items-center text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] tracking-wider text-white bg-[#3f51b5] rounded hover:bg-[#4558BE]">Pretrazi
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="inline-block min-w-full px-[50px] pt-3 align-middle bg-white rounded-bl-lg rounded-br-lg shadow-dashboard">
                        <table class="min-w-full shadow-lg" id="myTable">
                            <thead class="bg-[#EFF3F6]">
                                <tr class="border-b-[1px] border-[#e4dfdf]">
                                    <th class="px-4 py-3 leading-4 tracking-wider text-left text-blue-500">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" class="form-checkbox">
                                        </label>
                                    </th>
                                    <th class="px-4 py-4 leading-4 tracking-wider text-left">Ime i prezime<a href="#"><i class="ml-3 fa-lg fas fa-long-arrow-alt-down" onclick="sortTable()"></i></a></th>
                                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Email</th>
                                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Tip korisnika</th>
                                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Zadnji pristup sistemu</th>
                                    <th class="px-4 py-4"> </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                            @foreach($ucenici as $user)
                                <tr class="hover:bg-gray-200 hover:shadow-md border-b-[1px] border-[#e4dfdf]">
                                    <td class="px-4 py-4 whitespace-no-wrap">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" class="form-checkbox">
                                        </label>
                                    </td>
                                    <td class="flex flex-row items-center px-4 py-4">
                                        <img class="object-cover w-8 h-8 mr-2 rounded-full" src="/storage/image/{{$user->photo}}" alt=""/>
                                        <a href="{{ route('ucenikProfile', ['user' => $user->id]) }}">
                                            <span class="font-medium text-center">{{$user->name}}</span>
                                        </a>
                                    </td>
                                    <td class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">{{$user->email}}</td>
                                    <td class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">{{$user->userType->name}}</td>
                                    <td class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">{{$user->last_login_at}}</td>
                                    <td class="px-4 py-4 text-sm leading-5 text-right whitespace-no-wrap">
                                        <p class="inline cursor-pointer text-[20px] py-[10px] px-[30px] border-gray-300 dotsStudent hover:text-[#606FC7]">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </p>
                                        <div
                                            class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 dropdown-student">
                                            <div class="absolute right-[25px] w-56 mt-[7px] origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                                aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                                                <div class="py-1">
                                                    <a href="{{ route('ucenikProfile', ['user' => $user->id]) }}" tabindex="0"
                                                        class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                        role="menuitem">
                                                        <i class="far fa-file mr-[5px] ml-[5px] py-1"></i>
                                                        <span class="px-4 py-0">Pogledaj detalje</span>
                                                    </a>
                                                    <a href="{{ route('editUcenik', ['user' => $user->id]) }}" tabindex="0"
                                                        class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                        role="menuitem">
                                                        <i class="fas fa-edit mr-[1px] ml-[5px] py-1"></i>
                                                        <span class="px-4 py-0">Izmijeni korisnika</span>
                                                    </a>
                                                    <a href="{{ route('deleteUcenik', ['user' => $user->id]) }}" tabindex="0"
                                                        class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                        role="menuitem">
                                                        <i class="fa fa-trash mr-[5px] ml-[5px] py-1"></i>
                                                        <span class="px-4 py-0">Izbrisi korisnika</span>
                                                    </a>
                                                    <a href="#" tabindex="0"
                                                        class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                        role="menuitem">
                                                        <i class="fa fa-redo-alt mr-[3px] ml-[5px] py-1"></i>
                                                        <span class="px-4 py-0">Resetuj sifru</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pt-[20px]">
                            {{ $ucenici->links() }}

                        </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="mx-[40px] mt-[20px]">
                        <a href="{{route('noviUcenik')}}" class="btn-animation inline-flex items-center text-sm py-2.5 px-5 rounded-[5px] tracking-wider text-white bg-[#3f51b5] rounded hover:bg-[#4558BE]">
                            <i class="fas fa-plus mr-[15px]"></i> Novi ucenik
                        </a>
                    <div class="w-[360px] flex items-center px-6 py-4 my-4 text-lg bg-red-200 rounded-lg">
                        
                        <svg viewBox="0 0 24 24" class="w-5 h-5 mr-3 text-red-600 sm:w-5 sm:h-5">
                            <path fill="currentColor"
                                    d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z">
                            </path>
                        </svg>
                        <p class="font-medium text-red-600"> Ne postoji nijedan ucenik u bazi podataka </p>
                    </div>
                </div>   
            @endif          
        </section>
@endsection