<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Strona powitalna') }}
        </h2>

        <style>
            .container {
                margin: 0 auto 0;
            }

            .register {
                margin: 0 auto 0;
                width: 300px;
            }

            .register button {
                width: 100%
            }

            .box {
                margin-bottom: 5px;
                border-bottom: 1px solid black;
                padding-bottom: 10px;
                padding-top: 10px;
            }

            .box:last-of-type {
                border: none
            }


            @media (max-width: 575.98px) {
                .box * {
                    font-size: 13px
                }
            }

            .fw-bold {
                font-weight: 700 !important
            }
        </style>
    </x-slot>


    <div class="px-3 md:px-6 lg:px-12 py-1">
        <h1 class="text-center font-bold text-2xl mb-4">Serdecznie witamy na stronie</h1>

        <div class="mb-4">
            <p class = "mb-2">
                Nasza aplikacja umożliwia szybki dostęp do ulubionych stron bez konieczności szukania ich w zakładkach
                przeglądarki. Dzięki intuicyjnemu interfejsowi możesz tworzyć foldery i dowolnie rozmieszczać strony w
                nich. Aplikacja jest dostępna na wszystkich urządzeniach, dzięki czemu możesz mieć dostęp do
                swoich linków w dowolnym miejscu i o dowolnej porze.
            </p>

            <p>
                Ponadto, nasza aplikacja oferuje unikalne funkcje, takie jak możliwość udostępniania linków znajomym oraz
                wygodne wyszukiwanie stron w folderach. Dzięki tym funkcjom możesz wspólnie korzystać z ulubionych stron
                i dzielić się nimi z innymi osobami. Wszystko to jest dostępne w przyjaznym i intuicyjnym interfejsie,
                dzięki czemu możesz szybko i łatwo zarządzać swoimi linkami i udostępniać je znajomym. Dołącz do nas i
                skorzystaj z wygodnego sposobu na zarządzanie swoimi ulubionymi stronami już dziś!
            </p>
        </div>

        <div class="w-full md:w-4/5 xl:w-3/5 2xl:w-5/12 mx-auto">
            <div class="flex flex-wrap box">
                <div class="w-1/3"><img src="{{ URL::asset('/images/fast.jpg') }}" class="max-w-full h-auto"
                        alt="Zdjęcie 1"></div>
                <div class="w-2/3 px-3 md:px-5">
                    <div class="text-center fw-bold">Szybki dostęp do ulubionych stron</div>
                    <div>
                        Dzięki naszemu serwisowi szybko znajdziesz swoje ulubione strony bez konieczności ich
                        szukania w zakładkach przeglądarki.
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap box">
                <div class="w-2/3 px-3 md:px-5">
                    <div class="text-center fw-bold">Dostęp z każdego urządzenia</div>
                    <div>
                        Niezależnie od tego, czy korzystasz z komputera, tabletu czy telefonu, nasz serwis jest
                        dostępny na wszystkich urządzeniach.
                    </div>
                </div>
                <div class="w-1/3"><img src="{{ URL::asset('/images/responsive.png') }}" class="max-w-full h-auto"
                        alt="Zdjęcie 1"></div>
            </div>

            <div class="flex flex-wrap box">
                <div class="w-1/3"><img src="{{ URL::asset('/images/interface.jpg') }}" class="max-w-full h-auto"
                        alt="Zdjęcie 1"></div>
                <div class="w-2/3 px-3 md:px-5">
                    <div class="text-center fw-bold">Graficzny interfejs</div>
                    <div>
                        Dzięki przyjaznemu dla oka interfejsowi korzystanie z naszego serwisu jest proste i
                        przyjemne.
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap box">
                <div class="w-2/3 px-3 md:px-5">
                    <div class="text-center fw-bold">Udostępniaj zawartości znajomym</div>
                    <div>
                        Dzięki naszemu serwisowi możesz łatwo dzielić się swoimi ulubionymi stronami z przyjaciółmi
                        i rodziną.
                    </div>
                </div>
                <div class="w-1/3"><img src="{{ URL::asset('/images/sharing.jpg') }}" class="max-w-full h-auto"
                        alt="Zdjęcie 1"></div>
            </div>

            <div class="flex flex-wrap box">
                <div class="w-1/3"><img src="{{ URL::asset('/images/subfolders.jpg') }}" class="max-w-full h-auto"
                        alt="Zdjęcie 1"></div>
                <div class="w-2/3 px-3 md:px-5">
                    <div class="text-center fw-bold">Umieszczaj strony w folderach</div>
                    <div>
                        Za pomocą naszego serwisu możesz tworzyć foldery i umieszczać w nich swoje ulubione
                        strony, aby jełatwo znaleźć w przyszłości.
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap box">
                <div class="w-8/12">
                    <div class="text-center fw-bold">Dowolnie rozmieszczaj strony</div>
                    <div>
                        Z naszym serwisem możesz swobodnie układać swoje strony w folderach w taki sposób, jaki Ci
                        najbardziej odpowiada.
                    </div>
                </div>
                <div class="w-4/12"><img src="{{ URL::asset('/images/sort.jpg') }}" class="img-fluid" alt="Zdjęcie 1">
                </div>
            </div>
        </div>


    </div>

    <div class="px-6 py-1 mt-4 register pb-4">
        <div class="text-center"> Nie masz jeszcze konta? </div>
        <a href="{{ route('register') }}">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Zarejestruj się
            </button>
        </a>
    </div>
</x-main-layout>
