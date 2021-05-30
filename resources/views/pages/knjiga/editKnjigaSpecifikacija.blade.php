@extends('layouts.layout')

@section('editKnjigaSpecifikacija')
    <section class="w-screen h-screen pl-[80px] pb-4 text-gray-700">
        <!-- Heading of content -->
        <div class="heading">
            <div class="flex border-b-[1px] border-[#e4dfdf]">
                <div class="pl-[30px] py-[10px] flex flex-col">
                    <div>
                        <h1>
                            Izmijeni podatke
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
                                    <a href="#" class="text-gray-400 hover:text-blue-600">
                                        Izmijeni podatke
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            @if(Session::has('success'))
                <div class="fadeInOut absolute top-[91px] py-[15px] px-[30px] rounded-[15px] text-white bg-[#4CAF50] right-[20px] fadeIn">
                <i class="fa fa-check mr-[5px]" aria-hidden="true"></i> {{ Session::get('success') }}
                    @php
                        Session::forget('success');
                    @endphp
                </div>
            @endif
        </div>
        <div class="border-b-[2px] py-4 text-gray-500 border-gray-300 pl-[30px]">
            <a href="editKnjiga.php" class="inline hover:text-blue-800">
                Osnovni detalji
            </a>
            <a href="#" class="inline active-book-nav ml-[70px] hover:text-blue-800 ">
                Specifikacija
            </a>
            <a href="editKnjigaMultimedija.php" class="inline ml-[70px] hover:text-blue-800">
                Multimedija
            </a>
        </div>
        <!-- Space for content -->
        <div class="scroll height-content section-content">
            <form class="text-gray-700 forma">
                <div class="flex flex-row ml-[30px]">
                    <div class="w-[50%] mb-[150px]">
                        <div class="mt-[20px]">
                            <p>Broj strana <span class="text-red-500">*</span></p>
                            <input type="text" name="brStranaEdit" id="brStranaEdit" value="264" class="flex w-[45%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]" onkeydown="clearErrorsBrStranaEdit()"/>
                            @error('brStranaEdit')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-[20px]">
                            <p>Pismo <span class="text-red-500">*</span></p>
                            <select class="flex w-[45%] mt-2 px-2 py-2 border bg-white border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#576cdf]" name="pismoEdit" id="pismoEdit" onclick="clearErrorsPismoEdit()">
                                <option disabled></option>
                                <option selected value="">
                                    Cirilica
                                </option>
                                <option value="">
                                    Latinica
                                </option>
                                <option value="">
                                    Arapsko
                                </option>
                                <option value="">
                                    Kinesko
                                </option>
                            </select>
                            @error('pismoEdit')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-[20px]">
                            <p>Povez <span class="text-red-500">*</span></p>
                            <select class="flex w-[45%] mt-2 px-2 py-2 border bg-white border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#576cdf]" name="povezEdit" id="povezEdit" onclick="clearErrorsPovezEdit()">
                                <option disabled></option>
                                <option selected value="">
                                    Tvrdi
                                </option>
                                <option value="">
                                    Meki
                                </option>
                            </select>
                            @error('povezEdit')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-[20px]">
                            <p>Format <span class="text-red-500">*</span></p>
                            <select class="flex w-[45%] mt-2 px-2 py-2 border bg-white border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#576cdf]" name="formatEdit" id="formatEdit" onclick="clearErrorsFormatEdit()">
                                <option disabled></option>
                                <option value="">
                                    A1
                                </option>
                                <option value="">
                                    A2
                                </option>
                                <option selected value="">
                                    21 cm
                                </option>
                            </select>
                            @error('formatEdit')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-[20px]">
                            <p>International Standard Book Num <span class="text-red-500">*</span></p>
                            <input type="text" name="isbnEdit" id="isbnEdit" value="1546213456878" class="flex w-[45%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]" onkeydown="clearErrorsIsbnEdit()"/>
                            @error('isbnEdit')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="absolute bottom-0 w-full">
                    <div class="flex flex-row">
                        <div class="inline-block w-full text-white text-right py-[7px] mr-[100px]">
                            <button type="button"
                                    class="btn-animation shadow-lg mr-[15px] w-[150px] focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                            </button>
                            <button id="sacuvajSpecifikacijuEdit" type="submit"
                                    class="btn-animation shadow-lg w-[150px] disabled:opacity-50 focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] hover:bg-[#46A149] bg-[#4CAF50]" onclick="validacijaSpecifikacijaEdit()">
                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
