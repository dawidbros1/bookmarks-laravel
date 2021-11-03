<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dodaj kategorie') }}
        </h2>
    </x-slot>


    <x-jet-validation-errors> </x-jet-validation-errors>

    <x-form-section action="{{ route('category.store') }}">
        {{-- Tutył --}}
        <x-jet-label for="name" class="pl-2"> Nazwa: </x-jet-label>
        <x-jet-input name="name" value="{{ old('name') }}" type="text" class="border px-2 min-w-full mb-3">
        </x-jet-input>

        @error('name')
            <div class="simple-error">{{ $message }}</div>
        @enderror

        {{-- Obrazek --}}
        <x-jet-label for="image_url" class="pl-2"> Adres obrazeka: </x-jet-label>
        <x-jet-input name="image_url" value="{{ old('image_url') }}" type="text" class="border px-2 min-w-full mb-3">
        </x-jet-input>

        @error('image_url')
            <div class="simple-error">{{ $message }}</div>
        @enderror

        <div class="mb-2">
            Czy kategoria ma być publiczna?
            <input type="checkbox" name="public" @if ($settings->category_public) checked @endif>
        </div>

        <x-jet-button type="submit" class="">Zapisz</x-jet-button>
    </x-form-section>

    <x-back-button action="
                {{ route('category.list', ['view' => 'visible']) }}">
    </x-back-button>

</x-main-layout>
