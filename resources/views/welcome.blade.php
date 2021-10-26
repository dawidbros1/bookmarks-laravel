<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Strona powitalna') }}
        </h2>

        <style>
            .container {
                width: 70%;
                margin: 0 auto 0;
            }

            .box-item {
                border: 1px solid black;
                text-align: center;
                width: 33%;
                padding: 5px;
                margin: 0 auto 0;
                margin-bottom: 10px;
                box-sizing: border-box;
            }

            img {
                width: 100%;
                height: 185px;
                margin: 0 auto 0;
            }

            @media (max-width: 1536px) {
                .box-item {
                    width: 33%;
                }

                .container {
                    width: 80%;
                }
            }

            @media (max-width: 1280px) {
                .box-item {
                    width: 49%;
                }

                .container {
                    width: 100%;
                }

                img {
                    height: 135px;
                }
            }

            .register {
                margin: 0 auto 0;
                width: 300px;
            }

            .register button {
                width: 100%;
            }

            @media (max-width: 640px) {
                .box-item {
                    width: 98%;
                }

                img {
                    height: 200px;
                }
            }

        </style>
    </x-slot>


    <div class="px-6 py-1 container">
        <h1 class="text-center font-bold text-2xl mb-4">Serderznie witamy na naszej stronie</h1>

        <p class="mb-4">
            Serwis, na którym właśnie się znajdujesz, służy do tworzenia linków do zewnętrznych stron. Korzystając z
            naszego serwisu, możesz udostępnić zgromadzone przez siebie grupy odnośników znajomym za pomocą
            pojedynczego linka. Swoje elementy możesz umieszczać w podkatalogach, a także możesz je dowolnie
            rozmieszczać.
        </p>

        <p class="mb-2">Dlaczego powinieneś korzystać z naszych usług?</p>

        <div class="justify-center flex flex-wrap">
            <div class="box-item">
                <div class="title">Szybki dostęp do ulubionych stron</div>
                <img src="{{ URL::asset('/images/fast.jpg') }}" />

            </div>

            <div class="box-item">
                <div class="title">Dostęp z każdego urządzenia</div>
                <img src="{{ URL::asset('/images/responsive.png') }}" />
            </div>

            <div class="box-item">
                <div class="title">Graficzny interfejs</div>
                <img src="{{ URL::asset('/images/interface.jpg') }}" />
            </div>

            <div class="box-item">
                <div class="title">Udostępniaj zawartości znajomym</div>
                <img src="{{ URL::asset('/images/sharing.jpg') }}" />
            </div>

            <div class="box-item">
                <div class="title">Umieszczaj elementy w podfolderach</div>
                <img src="{{ URL::asset('/images/subfolders.jpg') }}" />
            </div>

            <div class="box-item">
                <div class="title">Dowolnie rozmieszczaj elementy</div>
                <img src="{{ URL::asset('/images/sort.jpg') }}" />
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
