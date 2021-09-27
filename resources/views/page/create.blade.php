<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dodaj stronę') }}
        </h2>
    </x-slot>

    <x-slot name="content">
        <x-jet-validation-errors> </x-jet-validation-errors>

        <x-form-section action="{{ route('page.store') }}">
            <x-slot name="content">
                {{-- Tutył --}}
                <x-jet-label for="name" class="pl-2"> Nazwa strony: </x-jet-label>
                <x-jet-input name="name" value="{{ old('name') }}" type="text" class="border px-2 min-w-full mb-3">
                </x-jet-input>

                @error('name')
                    <div class="simple-error">{{ $message }}</div>
                @enderror

                {{-- Obrazek --}}

                <div class="relative">
                    <x-jet-label for="image_url" class="pl-2"> Obrazek: </x-jet-label>
                    <x-jet-input name="image_url" value="{{ old('image_url') }}" type="text"
                        class="border px-2 min-w-full mb-3" id="image_url">
                    </x-jet-input>

                    {{-- <img src="{{ URL::asset('/images/paste.png') }}" alt="profile Pic" height="20" width="20"
                    class="bg-gray-100 absolute right-1 bottom-1 hover:cursor-pointer" title="Wklej obrazek podkategorii"
                    onclick="pasteImg('{{ $image_url_paste }}');"> --}}
                </div>

                @error('image_url')
                    <div class=" simple-error">{{ $message }}
                    </div>
                @enderror

                {{-- Obrazek --}}
                <x-jet-label for="link" class="pl-2"> Link do strony: </x-jet-label>
                <x-jet-input name="link" value="{{ old('link') }}" type="text" class="border px-2 min-w-full mb-3">
                </x-jet-input>

                @error('link')
                    <div class="simple-error">{{ $message }}</div>
                @enderror

                <div class="mb-2">
                    Czy strona ma być publiczna?
                    <input type="checkbox" name="public">
                </div>

                <input type="hidden" name="type" value="{{ $type }}">
                <input type="hidden" name="parent_id" value="{{ $parent->id }}">

                <x-jet-button type="submit" class="ml-2">Zapisz</x-jet-button>

            </x-slot>
        </x-form-section>

        {{-- <script src="{{ mix('js/pasteImg.js') }}"></script> --}}

        @if ($type == 'category')
            <x-back-button action="{{ route('category.show', ['id' => $parent->id]) }}">
            </x-back-button>
        @else
            <x-back-button action="{{ route('subcategory.show', ['id' => $parent->id]) }}">
            </x-back-button>
        @endif

    </x-slot>
</x-main-layout>
