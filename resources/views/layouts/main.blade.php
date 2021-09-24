<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">

    <!-- This is an example component -->

    @livewire('navigation-menu')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-full mx-auto py-2 text-center relative">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->

    <main>
        <div class="max-w-full mx-auto relative" {{-- up div => max-w-7xl mx-auto sm:px-6 lg:px-8 relative --}}>
            @include('shared.messages')
            {{ $content }}
        </div>
    </main>

    @stack('modals')
    @livewireScripts
</body>

</html>
