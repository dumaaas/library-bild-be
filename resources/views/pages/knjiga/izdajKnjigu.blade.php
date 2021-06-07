@extends('layouts.layout')

@section('izdajKnjigu')

<section class="w-screen h-screen pl-[80px] pb-2 text-gray-700">
            <!-- Heading of content -->
            <div class="heading">
                <div class="flex flex-row justify-between border-b-[1px] border-[#e4dfdf]">
                    <div class="py-[10px] flex flex-row">
                        <div class="w-[77px] pl-[30px]">
                            @if(count($knjiga->coverImage) > 0 )
                                <img src="/storage/image/{{$knjiga->coverImage[0]->photo}}" alt="">
                            @endif
                        </div>
                        <div class="pl-[15px]  flex flex-col">
                            <div>
                                <h1>
                                    {{$knjiga -> title}}
                                </h1>
                            </div>
                            <div>
                                <nav class="w-full rounded">
                                    <ol class="flex list-reset">
                                        <li>
                                            <a href="{{route('evidencijaKnjiga')}}" class="text-[#2196f3] hover:text-blue-600">
                                                Evidencija knjiga
                                            </a>
                                        </li>
                                        <li>
                                            <span class="mx-2">/</span>
                                        </li>
                                        <li>
                                            <a href="{{route('knjigaOsnovniDetalji', ['knjiga' => $knjiga])}}"
                                                class="text-[#2196f3] hover:text-blue-600">
                                                KNJIGA-{{$knjiga -> id}}
                                            </a>
                                        </li>
                                        <li>
                                            <span class="mx-2">/</span>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="text-gray-400 hover:text-blue-600">
                                                Izdaj knjigu
                                            </a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="pt-[24px] mr-[30px]">
                        <a href="{{route('otpisiKnjigu', ['knjiga' => $knjiga->id])}}" class="inline hover:text-blue-600">
                            <i class="fas fa-level-up-alt mr-[3px]"></i>
                            Otpisi knjigu
                        </a>
                        <a href="#" class="inline hover:text-blue-600 ml-[20px] pr-[10px]">
                            <i class="far fa-hand-scissors mr-[3px]"></i>
                            Izdaj knjigu
                        </a>
                        <a href="{{route('vratiKnjigu', ['knjiga' => $knjiga->id])}}" class="hover:text-blue-600 inline ml-[20px] pr-[10px]">
                            <i class="fas fa-redo-alt mr-[3px] "></i>
                            Vrati knjigu
                        </a>
                        <a href="{{route('rezervisiKnjigu', ['knjiga' => $knjiga])}}" class="hover:text-blue-600 inline ml-[20px] pr-[10px]">
                            <i class="far fa-calendar-check mr-[3px] "></i>
                            Rezervisi knjigu
                        </a>
                        <p class="inline cursor-pointer text-[25px] py-[10px] pl-[30px] border-l-[1px] border-[#e4dfdf] dotsIzdajKnjigu hover:text-[#606FC7]">
                            <i
                                class="fas fa-ellipsis-v"></i>
                        </p>
                        <div
                            class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 dropdown-izdaj-knjigu">
                            <div class="absolute right-0 w-56 mt-[7px] origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                                <div class="py-1">
                                    <a href="{{route('editKnjiga', ['knjiga' => $knjiga->id])}}" tabindex="0"
                                        class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                        role="menuitem">
                                        <i class="fas fa-edit mr-[1px] ml-[5px] py-1"></i>
                                        <span class="px-4 py-0">Izmijeni knjigu</span>
                                    </a>
                                    <a href="{{route('izbrisiKnjigu', ['knjiga' => $knjiga->id])}}" tabindex="0"
                                        class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                        role="menuitem">
                                        <i class="fa fa-trash mr-[5px] ml-[5px] py-1"></i>
                                        <span class="px-4 py-0">Izbrisi knjigu</span>
                                    </a>
                                </div>
                            </div>
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

            <!-- Space for content -->
            <div class="scroll height-content section-content">
                <form action="{{route('sacuvajIzdavanje', ['knjiga' => $knjiga->id])}}" method="POST"  class="text-gray-700 forma">
                @csrf
                    <div class="flex flex-row ml-[30px]">
                        <div class="w-[50%] mb-[100px] mr-[100px]">
                            <h3 class="mt-[20px] mb-[10px]">Izdaj knjigu</h3>
                            <div class="mt-[20px]">
                                <p>Izaberi ucenika koji zaduzuje knjigu <span class="text-red-500">*</span></p>
                                <select
                                    class="flex w-[90%] mt-2 px-2 py-2 border bg-white border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                                    name="ucenik" id="ucenikIzdavanje" onclick="clearErrorsUcenikIzdavanje()">
                                    <option disabled selected></option>
                                    @foreach($ucenici as $ucenik)
                                        <option value="{{$ucenik->id}}">{{$ucenik->name}}</option>
                                    @endforeach
                                </select>
                                @error('ucenik')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-[20px] flex justify-between w-[90%]">
                                <div class="w-[50%]">
                                    <p>Datum izdavanja <span class="text-red-500">*</span></p>
                                    <label class="text-gray-700" for="date">
                                        <input type="date" name="datumIzdavanja" id="datumIzdavanja" max="{{Carbon\Carbon::now()->format('Y-m-d')}}"
                                            class="flex w-[90%] mt-2 px-4 py-2 text-base placeholder-gray-400 bg-white border border-gray-300 appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                                            onclick="clearErrorsDatumIzdavanja();"
                                            onchange="funkcijaDatumVracanja({{$rokPozajmljivanja->value}});" />
                                    </label>
                                    @error('datumIzdavanja')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-[50%]">
                                    <p>Datum vracanja</p>
                                    <label class="text-gray-700" for="date">
                                        <input type="date" id="datumVracanja" name="datumVracanja"
                                            class="flex w-[90%] mt-2 px-2 py-2 text-base text-gray-400 bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                                            readonly="readonly" />
                                    </label>
                                    <div>
                                        <p>Rok vracanja: {{$rokPozajmljivanja->value}} dana</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-[50%] mb-[100px]">
                            <div class="border-[1px] border-[#e4dfdf] w-[360px] mt-[75px]">
                                <h2 class="mt-[20px] ml-[30px]">KOLICINE</h2>
                                <div class="ml-[30px] mr-[70px] mt-[20px] flex flex-row justify-between">
                                    <div class="text-gray-500 ">
                                        <p>Na raspolaganju:</p>
                                        <p class="mt-[20px]">Rezervisano:</p>
                                        <p class="mt-[20px]">Izdato:</p>
                                        <p class="mt-[20px]">U prekoracenju:</p>
                                        <p class="mt-[20px]">Ukupna kolicina:</p>
                                    </div>
                                    <div class="text-center pb-[30px]">
                                        <p
                                            class=" bg-green-200 text-green-700 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                            {{$knjiga -> quantity- $knjiga->reservedBooks - $knjiga->rentedBooks}}
                                            primjeraka</p>
                                        <a href="{{route('iznajmljivanjeAktivne', ['knjiga' => $knjiga])}}">
                                            <p
                                                class=" mt-[16px] bg-yellow-200 text-yellow-700 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                                {{$knjiga -> reservedBooks}} primjeraka</p>
                                        </a>
                                        <a href="{{route('iznajmljivanjeIzdate', ['knjiga' => $knjiga])}}">
                                            <p
                                                class=" mt-[16px] bg-blue-200 text-blue-800 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                                {{$knjiga -> rentedBooks}} primjeraka</p>
                                        </a>
                                        <a href="{{route('iznajmljivanjePrekoracenje', ['knjiga' => $knjiga])}}">
                                            <p
                                                class=" mt-[16px] bg-red-200 text-red-800 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                                {{count($prekoraceneKnjige)}} primjeraka</p>
                                        </a>
                                        <p
                                            class=" mt-[16px] bg-purple-200 text-purple-700 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                            {{$knjiga -> quantity}} primjeraka</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute bottom-0 w-full">
                        <div class="flex flex-row">
                            <div class="inline-block w-full text-right py-[7px] mr-[100px] text-white">
                                <button type="reset"
                                    class="btn-animation shadow-lg mr-[15px] w-[150px] focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                    <i class="fas fa-times mr-[7px]"></i> Ponisti 
                                </button>
                                <button id="izdajKnjigu" type="submit"
                                    class="btn-animation shadow-lg w-[150px] disabled:opacity-50 focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] hover:bg-[#46A149] bg-[#4CAF50]"
                                    onclick="validacijaIzdavanje()">
                                    <i class="fas fa-check mr-[7px]"></i> Izdaj knjigu 
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>

@endsection
