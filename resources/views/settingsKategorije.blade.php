@extends('layouts.layout')

@section('settingsKategorije')
<section class="w-screen h-screen pl-[80px] py-4 text-gray-700">
            <!-- Heading of content -->
            <div class="heading mt-[7px]">
                <div class="border-b-[1px] border-[#e4dfdf]">
                    <div class="pl-[30px] pb-[21px]">
                        <h1>
                            Settings
                        </h1>
                    </div>
                </div>
            </div>
            <div class="py-4 text-gray-500 border-b-[1px] border-[#e4dfdf] pl-[30px]">
                <a href="{{route('settingsPolisa')}}" class="inline hover:text-blue-800">
                    Polisa
                </a>
                <a href="{{route('settingsKategorije')}}" class="inline ml-[70px] hover:text-blue-800 active-book-nav">
                    Kategorije
                </a>
                <a href="settingsZanrovi.php" class="inline ml-[70px] hover:text-blue-800">
                    Zanrovi
                </a>
                <a href="{{route('settingsIzdavac')}}" class="inline ml-[70px] hover:text-blue-800">
                    Izdavac
                </a>
                <a href="{{route('settingsPovez')}}" class="inline ml-[70px] hover:text-blue-800">
                    Povez
                </a>
                <a href="settingsFormat.php" class="inline ml-[70px] hover:text-blue-800">
                    Format
                </a>
                <a href="{{route('settingsPismo')}}" class="inline ml-[70px] hover:text-blue-800">
                    Pismo
                </a>
            </div>
            <div class="height-kategorije pb-[30px] scroll">
                <div class="flex items-center px-[50px] py-8 space-x-3 rounded-lg">
                    <a href="{{route('novaKategorija')}}"
                        class="btn-animation inline-flex items-center text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] tracking-wider text-white bg-[#3f51b5] rounded hover:bg-[#4558BE]">
                        <i class="fas fa-plus mr-[15px]"></i> Nova kategorija
                    </a>
                </div>

                <div
                    class="inline-block min-w-full px-[50px] pt-3 align-middle bg-white rounded-bl-lg rounded-br-lg shadow-dashboard">
                    <table class="min-w-full shadow-lg" id="myTable">
                        <thead class="bg-[#EFF3F6]">
                            <tr class="border-b-[1px] border-[#e4dfdf]">
                                <th class="px-4 py-4 leading-4 tracking-wider text-left text-blue-500">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox">
                                    </label>
                                </th>
                                <th class="px-4 py-4 leading-4 tracking-wider text-left">Naziv kategorije<a href="#"><i
                                            class="ml-3 fa-lg fas fa-long-arrow-alt-down" onclick="sortTable()"></i></a>
                                </th>
                                <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Opis</th>
                                <th class="px-4 py-4"> </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                        @foreach($kategorije as $kategorija)
                            <tr class="hover:bg-gray-200 hover:shadow-md border-b-[1px] border-[#e4dfdf]">
                                <td class="px-4 py-4 whitespace-no-wrap">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox">
                                    </label>
                                </td>
                                <td class="flex flex-row items-center px-4 py-4">
                                    <i class="fas fa-utensils fa-lg text-[#707070]"></i>
                                    <p class="ml-4 text-center">{{$kategorija->name}}</p>
                                </td>
                                <td class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">{{$kategorija->description}}</td>
                                <td class="px-4 py-4 text-sm leading-5 text-right whitespace-no-wrap">
                                    <p class="inline cursor-pointer text-[20px] py-[10px] px-[30px] border-gray-300 dotsCategory hover:text-[#606FC7]">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </p>
                                    <div
                                        class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 dropdown-category">
                                        <div class="absolute right-[25px] w-56 mt-[7px] origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                            aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                                            <div class="py-1">
                                                <a href="{{route('editKategorija', ['kategorija' => $kategorija->id])}}" tabindex="0"
                                                    class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                    role="menuitem">
                                                    <i class="fas fa-edit mr-[1px] ml-[5px] py-1"></i>
                                                    <span class="px-4 py-0">Izmijeni kategoriju</span>
                                                </a>
                                                <a href="{{route('izbrisiKategoriju', ['kategorija' => $kategorija->id])}}" tabindex="0"
                                                    class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                    role="menuitem">
                                                    <i class="fa fa-trash mr-[5px] ml-[5px] py-1"></i>
                                                    <span class="px-4 py-0">Izbrisi kategoriju</span>
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
                    {{ $kategorije->links() }}

                </div>

                </div>
            </div>

        </section>
        @endsection