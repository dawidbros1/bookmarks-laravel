@if ($message = Session::get('success'))
    <x-message class="bg-green-100 border-green-400 text-green-700">
        <x-slot name="message">{{ $message }}</x-slot>
    </x-message>
@endif

@if ($message = Session::get('error'))
    <x-message class="bg-red-100 border-red-400 text-red-700">
        <x-slot name="message">{{ $message }}</x-slot>
    </x-message>
@endif

@if ($message = Session::get('warning'))
    <x-message class="bg-red-100 border-red-400 text-red-700">
        <x-slot name="message">{{ $message }}</x-slot>
    </x-message>
@endif

@if ($message = Session::get('info'))

@endif
