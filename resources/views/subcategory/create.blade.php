<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dodaj podkategorie') }}
        </h2>
    </x-slot>

    <x-jet-validation-errors> </x-jet-validation-errors>

    <x-form-section action="{{ route('subcategory.store') }}">
        {{-- Tutył --}}
        <x-jet-label for="name" class="pl-2"> Nazwa: </x-jet-label>
        <x-jet-input name="name" value="{{ old('name') }}" type="text" class="border px-2 min-w-full mb-3">
        </x-jet-input>

        @error('name')
            <div class="simple-error">{{ $message }}</div>
        @enderror

        {{-- Obrazek --}}
        <div class="relative">
            <x-jet-label for="image_url" class="pl-2"> Obrazek: </x-jet-label>
            <x-jet-input name="image_url" value="{{ old('image_url') }}" type="text"
                class="border px-2 min-w-full mb-3" id="image_url"></x-jet-input>
            {{-- onclick="pasteImg('{{ $image_url_paste }}');" --}}
            <img src="{{ URL::asset('/images/paste.png') }}" alt="profile Pic" height="20" width="20"
                class="bg-gray-100 absolute right-1 bottom-1 hover:cursor-pointer" title="Wklej obrazek kategorii"
                onclick="pasteImg('{{ $category_image }}');">
        </div>

        @error('image_url')
            <div class="simple-error">{{ $message }}</div>
        @enderror

        <div class="mb-2">
            Czy kategoria ma być publiczna?
            <input type="checkbox" name="public" checked>
        </div>

        <input type="hidden" name="category_id" value="{{ $category_id }}">

        <x-jet-button type="submit">Zapisz</x-jet-button>
    </x-form-section>

    <x-back-button action="{{ route('category.show', ['id' => $category_id, 'view' => $view]) }}">
    </x-back-button>
</x-main-layout>
