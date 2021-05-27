@extends('layouts.layout')

@section('settingsPolisa')
    @can('isAdmin')
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
                <a href="settingsPolisa.php" class="inline hover:text-blue-800 active-book-nav">
                    Polisa
                </a>
                <a href="settingsKategorije.php" class="inline ml-[70px] hover:text-blue-800">
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
                <a href="settingsPismo.php" class="inline ml-[70px] hover:text-blue-800">
                    Pismo
                </a>
            </div>
            <div class="height-ucenikProfile pb-[30px] scroll">
                <!-- Space for content -->
                <div class="section- mt-[20px]">
                    <div class="flex flex-col">
                        <div class="pl-[30px] flex border-b-[1px] border-[#e4dfdf]  pb-[20px]">
                            <div>
                                <h3>
                                    Rok za rezervaciju
                                </h3>
                                <p class="pt-[15px] max-w-[400px]">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum eligendi nihil, vel
                                    necessitatibus saepe laboriosam! Perspiciatis laboriosam culpa veritatis ea
                                    voluptatum commodi tempora unde, dolorum debitis quia id dicta vitae.
                                </p>
                            </div>
                            <div class="relative flex ml-[60px] mt-[20px]">
                                <form action="{{route('izmijeniRokRezervacije')}}" method="POST">
                                @csrf
                                    <div class="flex">
                                        <input type="text" name="rokRezervacije"
                                            class="h-[50px] flex-1 w-full px-4 py-2 text-sm text-gray-700 placeholder-gray-400 bg-white border-[1px]  border-[#e4dfdf]  rounded-lg shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                                            placeholder="{{$rokRezervacije->value}}" />
                                        <p class="ml-[10px] mt-[10px]">dana</p>
                                    </div>
                                    <div>
                                        <button class="btn-animation mt-[10px] text-white shadow-lg w-[150px] disabled:opacity-50 focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] hover:bg-[#46A149] bg-[#4CAF50]">
                                            Sacuvaj
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="pl-[30px] flex border-b-[1px] border-[#e4dfdf]  py-[20px]">
                            <div>
                                <h3>
                                    Rok pozajmljivanja
                                </h3>
                                <p class="pt-[15px] max-w-[400px]">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum eligendi nihil, vel
                                    necessitatibus saepe laboriosam! Perspiciatis laboriosam culpa veritatis ea
                                    voluptatum commodi tempora unde, dolorum debitis quia id dicta vitae.
                                </p>
                            </div>
                            <div class="relative flex ml-[60px] mt-[20px]">
                            <form action="{{route('izmijeniRokPozajmljivanja')}}" method="POST">
                            @csrf
                                    <div class="flex">
                                        <input type="text" name="rokPozajmljivanja"
                                            class="h-[50px] flex-1 w-full px-4 py-2 text-sm text-gray-700 placeholder-gray-400 bg-white border-[1px]  border-[#e4dfdf]  rounded-lg shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                                            placeholder="{{$rokPozajmljivanja->value}}" />
                                        <p class="ml-[10px] mt-[10px]">dana</p>
                                    </div>
                                    <div>
                                        <button class="btn-animation mt-[10px] text-white shadow-lg w-[150px] disabled:opacity-50 focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] hover:bg-[#46A149] bg-[#4CAF50]">
                                            Sacuvaj
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="pl-[30px] flex border-b-[1px] border-[#e4dfdf]  py-[20px]">
                            <div>
                                <h3>
                                    Rok prekoracenja
                                </h3>
                                <p class="pt-[15px] max-w-[400px]">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum eligendi nihil, vel
                                    necessitatibus saepe laboriosam! Perspiciatis laboriosam culpa veritatis ea
                                    voluptatum commodi tempora unde, dolorum debitis quia id dicta vitae.
                                </p>
                            </div>
                            <div class="relative flex ml-[60px] mt-[20px]">
                            <form action="{{route('izmijeniRokPrekoracenja')}}" method="POST">
                            @csrf
                                    <div class="flex">
                                        <input type="text" name="rokPrekoracenja"
                                            class="h-[50px] flex-1 w-full px-4 py-2 text-sm text-gray-700 placeholder-gray-400 bg-white border-[1px]  border-[#e4dfdf]  rounded-lg shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                                            placeholder="{{$rokPrekoracenja->value}}" />
                                        <p class="ml-[10px] mt-[10px]">dana</p>
                                    </div>
                                    <div>
                                        <button class="btn-animation mt-[10px] text-white shadow-lg w-[150px] disabled:opacity-50 focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] hover:bg-[#46A149] bg-[#4CAF50]">
                                            Sacuvaj
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
