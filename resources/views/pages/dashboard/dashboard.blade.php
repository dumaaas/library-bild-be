@extends('layouts.layout')

@section('dashboard')
    <section class="w-screen h-screen pl-[80px] py-4 text-gray-700">
        <!-- Heading of content -->
        <div class="heading mt-[7px]">
            <h1 class="pl-[30px] pb-[21px]  border-b-[1px] border-[#e4dfdf] ">
                Dashboard
            </h1>
        </div>
        <!-- Space for content -->
        <div class="pl-[30px] scroll height-dashboard overflow-auto mt-[20px] pb-[30px]">
            <div class="flex flex-row justify-between">
                <div class="mr-[30px]">
                    <h3 class="uppercase mb-[20px]">Aktivnosti</h3>
                    <!-- Activity Cards -->
                    @foreach($aktivnosti as $aktivnost)
                        <div class="activity-card flex flex-row mb-[30px]">
                        <div class="w-[60px] h-[60px]">
                            <img class="rounded-full" src="img/profileStudent.jpg" alt="">
                        </div>
                        <div class="ml-[15px] mt-[5px] flex flex-col">
                            <div class="text-gray-500 mb-[5px]">
                                <p class="uppercase">
                                    Izdavanje knjige
                                    <span class="inline lowercase">
                                            - {{$aktivnost->rent_date->diffForHumans()}}
                                        </span>
                                </p>
                            </div>
                            <div class="">
                                <p>
                                    <a href="{{route('bibliotekarProfile', ['bibliotekar' => $aktivnost->librarian])}}" class="text-[#2196f3] hover:text-blue-600">
                                        {{$aktivnost->librarian->name}}
                                    </a>
                                    rented a book
                                    <a  href="{{route('knjigaOsnovniDetalji', ['knjiga' => $aktivnost->book])}}" class="font-medium">
                                        {{$aktivnost->book->title}}
                                    </a>
                                    to
                                    <a href="{{route('ucenikProfile', ['ucenik' => $aktivnost->student])}}" class="text-[#2196f3] hover:text-blue-600">
                                        {{$aktivnost->student->name}}
                                    </a>
                                    on
                                    <span class="font-medium">
                                        {{$aktivnost->rent_date}}.
                                    </span>
                                    <a href="{{route('izdavanjeDetalji', ['knjiga' => $aktivnost->book, 'ucenik' => $aktivnost->student])}}" class="text-[#2196f3] hover:text-blue-600">
                                        more details >>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="inline-block w-full mt-4">
                        <a href="{{route('dashboardAktivnost')}}"
                           class="btn-animation block text-center w-full px-4 py-2 text-sm tracking-wider text-gray-600 transition duration-300 ease-in border-[1px] border-gray-400 rounded hover:bg-gray-200 focus:outline-none focus:ring-[1px] focus:ring-gray-300">
                            Show
                        </a>
                    </div>
                </div>
                <div class="mr-[50px] ">
                    <h3 class="uppercase mb-[20px] text-left">
                        Rezervacije knjiga
                    </h3>
                    <div>
                        <table class="w-[560px] table-auto">
                            <tbody class="bg-gray-200">
                                @foreach($rezervacije as $rezervacija)
                                    <tr class="bg-white border-b-[1px] border-[#e4dfdf]">
                                    <td class="flex flex-row items-center px-2 py-4">
                                        <img class="object-cover w-8 h-8 rounded-full "
                                             src="img/profileStudent.jpg" alt="" />
                                        <a href="{{route('ucenikProfile', ['ucenik' => $rezervacija->student])}}" class="ml-2 font-medium text-center">
                                            {{$rezervacija->student->name}}
                                        </a>
                                    <td>
                                    </td>
                                    <td class="px-2 py-2">
                                        <a href="{{route('knjigaOsnovniDetalji', ['knjiga' => $rezervacija->book])}}">
                                            {{$rezervacija->book->title}}
                                        </a>
                                    </td>
                                    <td class="px-2 py-2">
                                        <span class="px-[10px] py-[3px] bg-gray-200 text-gray-800 px-[6px] py-[2px] rounded-[10px]">
                                            {{$rezervacija->reservation_date->toDateString()}}
                                        </span>
                                    </td>
                                    <td class="px-2 py-2">
                                        <a href="#" class="hover:text-green-500 mr-[5px]">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a href="#" class="hover:text-red-500 ">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-right mt-[5px]">
                            <a href="{{route('aktivneRezervacije')}}" class="text-[#2196f3] hover:text-blue-600">
                                <i class="fas fa-calendar-alt mr-[4px]" aria-hidden="true"></i>
                                Prikazi sve
                            </a>
                        </div>
                    </div>
                    <div class="relative">
                        <h3 class="uppercase mb-[20px] text-left py-[30px]">
                            Statistika
                        </h3>
                        <div class="text-right">
                            <div class="flex pb-[30px]">
                                <a class="w-[145px] text-[#2196f3] hover:text-blue-600" href="{{route('izdateKnjige')}}">
                                    Izdate knjige
                                </a>
                                <div class="ml-[30px] bg-green-600 transition duration-200 ease-in  hover:bg-green-900 stats-bar-green h-[26px]" style="width: {{$izdateNum}}px">

                                </div>
                                <p class="ml-[10px] number-green text-[#2196f3] hover:text-blue-600">
                                    {{$izdateNum}}
                                </p>
                            </div>
                            <div class="flex pb-[30px]">
                                <a class="w-[145px] text-[#2196f3] hover:text-blue-600" href="{{route('aktivneRezervacije')}}">
                                    Rezervisane knjige
                                </a>
                                <div class="ml-[30px] bg-yellow-600 transition duration-200 ease-in  hover:bg-yellow-900 stats-bar-yellow  h-[26px]" style="width: {{$rezervisaneNum}}px">

                                </div>
                                <p class="ml-[10px] text-[#2196f3] hover:text-blue-600 number-yellow">
                                    {{$rezervisaneNum}}
                                </p>
                            </div>
                            <div class="flex pb-[30px]">
                                <a class="w-[145px] text-[#2196f3] hover:text-blue-600" href="{{route('knjigePrekoracenje')}}">
                                    Knjige u prekoracenju
                                </a>
                                <div class="ml-[30px] bg-red-600 transition duration-200 ease-in hover:bg-red-900 stats-bar-red h-[26px]" style="width: {{$prekoraceneNum}}px">

                                </div>
                                <p class="ml-[10px] text-[#2196f3] hover:text-blue-600 number-red">
                                    {{$prekoraceneNum}}
                                </p>
                            </div>
                        </div>
                        <div class="absolute h-[220px] w-[1px] bg-black top-[78px] left-[174px]">
                        </div>
                        <div class="absolute flex conte left-[175px] border-t-[1px] border-[#e4dfdf] top-[248px] pr-[40px]">
                            <p class="ml-[2px]">
                                0
                            </p>
                            <p class="ml-[38px]">
                                50
                            </p>
                            <p class="ml-[33px]">
                                100
                            </p>
                            <p class="ml-[26px]">
                                150
                            </p>
                            <p class="ml-[26px]">
                                200
                            </p>
                            <p class="ml-[26px]">
                                250
                            </p>
                            <p class="ml-[26px]">
                                300
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection