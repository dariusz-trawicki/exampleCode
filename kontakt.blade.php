<x-layout>
    <x-breadcrumbs :links="['Kontakt' => route('kontakt')]"/>
    <section class="dark:bg-gray-900">
        <div class="grid grid-cols-1 md:grid-cols-10 w-full mt-12 md:mt-0 pb-4">
            {{--<div class="bg-purple-100 p-8 lg:p-12 xl:min-h-96 order-2 md:order-1" data-aos="fade-right">--}}
            <div class="col-span-5 lg:col-span-4 bg-white lg:p-8 md:min-h-48 order-2 md:order-1" data-aos="fade-right">
                <div class="pl-2 sm:pl-16 md:pl-8 w-full text-base sm:text-lg md:pl-8 lg:px-4 pt-6 lg:pt-0">
                    <span class="block pl-8">DANE KONTAKTOWE</span>
                    <ul class="list-none ">
                        <li class="mt-3">
                            <div class="flex items-center space-x-2 order-1 sm:order-2">
                                    <span class="bg-gold rounded-full w-6 h-6
                                    text-base text-white text-center">
                                        <i class="fas fa-info"></i>
                                    </span>
                                <span class="ml-2">Piekarnia-cukiernia Eugeniusz Lipiński</span>
                            </div>
                        </li>
                        <li class="mt-1">
                            <div class="flex items-center space-x-2 order-1 sm:order-2">
                                <a href="tel:+583425614"><span><i class="fas fa-phone-alt text-lg text-gold"></i></span>
                                    <span class="ml-2 font-sans text-sm text-gray-500">58 342 56 14</span></a>
                            </div>
                        </li>
                        <li class="mt-1">
                            <a href="mailto:el@piekarnia-el.pl"><span><i class="far fa-envelope text-lg text-gold"></i></span>
                                <span class="ml-2">el@piekarnia-el.pl</span>
                            </a>
                        </li>
                        <li class="mt-1">
                            <i class="fas fa-location-arrow text-lg text-gold"></i>
                            <span class="">ul. Słowackiego <span class="font-sans text-sm text-gray-700">53, 80-257</span> Gdańsk</span>
                        </li>
                        <li class="mt-1 pl-5">
                            NIP: <span class="font-sans text-sm text-gray-500">584 035 38 84</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-span-5 lg:col-span-6 order-1 md:order-2 md:min-h-48 md:pt-8 md:pl-0" data-aos="fade-left">
                <img class="" src="{{ asset('img/bg/klosy_cztery_cut.jpg') }}" alt="intro">
            </div>
        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2">
            <div class="flex flex-col items-center justify-center w-full px-2 py-2 mx-auto lg:py-0">
                <div class="w-full bg-white dark:border md:mt-0 xl:p-0
                            dark:bg-gray-800 dark:border-gray-700">
                    <div x-data="{ flash: true }" class="relative" role="alert">
                        @if(session()->get('email_succes'))
                            <div x-show="flash" class="relative p-4 mb-4 text-base sm:text-lg sm:mx-10 text-green-800
                                rounded-lg border-solid border-1 border-l-2 border-green-200 bg-green-50" role="alert">
                                <strong>Wiadomość została wysłana. Dziękujemy.</strong>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                       stroke-width="1.5" @click="flash = false"
                                       stroke="currentColor" class="h-6 w-6 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                  </svg>
                                </span>
                            </div>
                        @elseif (session()->get('email_succes')===false)
                            <div x-show="flash" class="relative p-4 mb-4 md:mx-10 md:mt-10 text-base
                                text-red-800 rounded-lg border-solid border-1 border-l-2 border-red-200
                                bg-red-50 " role="alert">
                                <strong>Przepraszamy, ale nie udało się wysłać wiadomości.<br>Proszę spróbować później.</strong>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                       stroke-width="1.5" @click="flash = false"
                                       stroke="currentColor" class="h-6 w-6 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                  </svg>
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="p-4 space-y-1 sm:px-8 ">
                        <form class="space-y-4 md:space-y-5" action="{{ route('sendmail') }}"
                              method="POST">
                            @csrf
                            <div>
                                {{--<label for="name" class="block mb-1 text-base font-medium text-gray-900--}}
                                {{--dark:text-white">Nazwa firmy lub imię i nazwisko (*)</label>--}}
                                <x-label for="name" :required="true">Nazwa firmy lub imię i nazwisko</x-label>
                                <x-text-input name="name" placeholder="Nazwa/Imię i nazwisko" />
                                @error('name')
                                <label for="name" class="block mb-2 text-base font-medium text-red-500
                                    dark:text-red-500">{{ $message }}</label>
                                @enderror
                            </div>
                            <div>
                                <x-label for="email">Email</x-label>
                                <x-text-input name="email" placeholder="Email" :required="false"/>
                                @error('email')
                                <label for="email" class="block mb-2 text-base font-medium text-red-500
                                    dark:text-red-500">{{ $message }}</label>
                                @enderror
                            </div>
                            <div>
                                <x-label for="message" :required="true">Wiadomość</x-label>
                                <x-text-input type="textarea" name="message" />
                                @error('message')
                                <label for="message" class="block mb-2 text-base font-medium text-red-500
                                    dark:text-red-500">{{ $message }}</label>
                                @enderror
                            </div>
                            <div>
                                <x-label for="captcha" :required="true">Antyspam</x-label>
                                <div class="grid grid-cols-1 lg:grid-cols-8
                                auto-cols-max place-items-center items-center">

                                    <div class="captcha lg:col-span-4" id="captcha_img">
                                        <span class="">{!! captcha_img() !!}</span>
                                    </div>
                                    <div class="mt-2 lg:mt-0 lg:col-span-1">
                                        <button type="button" class="bg-gold border border-gray-100 rounded-lg
                                                    text-white  w-8 h-8 md:w-10 md:h-10 hover:bg-gold2" id="reload">
                                            <i class="fa-solid fa-rotate-right"></i>
                                        </button>
                                    </div>
                                    <div class="mt-2 lg:mt-0 lg:col-span-3" id="antyspam">
                                        <input id="captcha" type="text"
                                               @class([
                                                    'bg-neutral-50 border border-gray-300 text-gray-900 sm:text-base
                                                    rounded-lg focus:border-gray-500 focus:ring-0 block w-full p-2.5 ',
                                                    'ring-1 ring-red-300' => $errors->has('captcha'),
                                                ])
                                               placeholder="Przepisz z obrazka" name="captcha" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="flex items-center" id="antyspam_err">
                                    @error('captcha')
                                    <label for="captcha" class="block text-base font-medium text-red-500
                                        dark:text-red-500">Błędnie wypełnione pole antyspamowe</label>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <x-label for="wynik" :required="true">Proszę wpisać cyfrą wynik działania: dwa plus dwa</x-label>
                                <x-text-input name="wynik" placeholder="Wynik" />
                                @error('wynik')
                                <label for="wynik" class="block mb-1 text-base font-medium text-red-500
                                    dark:text-red-500">Podano nieprawidłowy wynik</label>
                                @enderror
                            </div>
                            <button type="submit" class="w-full mt-4 text-white bg-gold hover:bg-gold2
                                    focus:ring-0 focus:outline-none focus:ring-blue-300 active:ring-0
                                    font-medium rounded-lg text-md px-5 py-2.5 text-center">Wyślij</button>
                            <p>(*) <i>Należy wypełnić.</i></p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="w-full pt-2 sm:pt-16">
                <div class="google-maps border  border-gray-400">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2323.7333334338573!2d18.58198577913929!3d54.37936100865248!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46fd74e5d84def1f%3A0xef536fc2c1e4c07e!2sPiekarnia-Cukiernia+Eugeniusz+Lipi%C5%84ski!5e0!3m2!1spl!2spl!4v1397643173006"
                            width="600"
                            height="800"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy">

                    </iframe>
                </div>
            </div>
        </div>
    </section>
</x-layout>