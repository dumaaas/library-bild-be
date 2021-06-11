@extends('layouts.layout')

@section('autorProfile')
    <section class="w-screen h-screen pl-[80px] pb-4 text-gray-700">
        <!-- Heading of content -->
        <div class="heading">
            <div class="flex justify-between border-b-[1px] border-[#e4dfdf]">
                <div class="pl-[30px] py-[10px] flex flex-col">
                    <div>
                        <h1>
                            {{$autor -> name}}
                        </h1>
                    </div>
                    <div>
                        <nav class="w-full rounded">
                            <ol class="flex list-reset">
                                <li>
                                    <a href="../autori" class="text-[#2196f3] hover:text-blue-600">
                                        Evidencija autora
                                    </a>
                                </li>
                                <li>
                                    <span class="mx-2">/</span>
                                </li>
                                <li>
                                    <a href="{{ route('autorProfile', ['autor' => $autor->id]) }}" class="text-gray-400 hover:text-blue-600">
                                        AUTOR-{{$autor->id}}
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="pt-[24px] pr-[30px]">
                    <p class="inline cursor-pointer text-[25px] py-[10px] pl-[30px] border-l-[1px] border-gray-300 dotsAutor hover:text-[#606FC7]">
                        <i
                            class="fas fa-ellipsis-v"></i>
                    </p>
                    <div
                        class="z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 dropdown-autor">
                        <div class="absolute right-0 w-56 mt-[2px] origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                             aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                            <div class="py-1">
                                <a href="{{ route('editAutor', ['autor' => $autor->id]) }}" tabindex="0"
                                   class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                   role="menuitem">
                                    <i class="fas fa-edit mr-[1px] ml-[5px] py-1"></i>
                                    <span class="px-4 py-0">Izmijeni autora</span>
                                </a>
                                <a href="#" tabindex="0" id="{{$autor->id}}"
                                   class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600 show-izbrisiModal"
                                   role="menuitem">
                                    <i class="fa fa-trash mr-[5px] ml-[5px] py-1"></i>
                                    <span class="px-4 py-0">Izbriši autora</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Space for content -->
        <div class="pl-[30px] height-profile pb-[30px] scroll mt-[20px]">
            <div class="mr-[30px]">
                <div class="mt-[20px]">
                    <span class="text-gray-500">Ime i prezime</span>
                    <p class="font-medium">{{$autor->name}}</p>
                </div>
                <div class="mt-[40px]">
                    <span class="text-gray-500">Opis</span>
                    <p class="font-medium max-w-[550px]">
                        {!! $autor->biography !!}
                    </p>
                </div>
            </div>
        </div>
        <!--Modal-->
        <div
            class="absolute z-20 top-0 left-0 items-center justify-center hidden w-full h-screen bg-black bg-opacity-10 izbrisi-modal_{{$autor->id}}" id="{{$autor->id}}">
            <!-- Modal -->
            <div class="w-[500px] bg-white rounded shadow-lg md:w-1/3">
                <!-- Modal Header -->
                <div class="flex items-center justify-between px-[30px] py-[20px] border-b">
                    <h3>Da li ste sigurni da želite da izbrišete autora?</h3>
                    <button class="text-black close ponisti focus:outline-none" id="{{$autor->id}}">
                        <span aria-hidden="true" class="text-[30px]">&times;</span>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="flex items-center justify-center px-[30px] py-[20px] border-t w-100 text-white">
                    <a href="{{ route('deleteAutor', ['autor' => $autor->id]) }}"
                        class=" text-center shadow-lg mr-[15px] w-[150px] focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                        <i class="fas fa-check mr-[7px]"></i> Izbriši
                    </a>
                    <a href="#" id="{{$autor->id}}" class="ponisti shadow-lg w-[150px] focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] bg-[#F44336] hover:bg-[#F55549] text-center">
                    <i class="fas fa-times mr-[7px]"></i> Poništi 
                    </a>
                </div>
            </div>
         </div>
    </section>
@endsection
