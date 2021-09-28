<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edycja kategorii') }}
        </h2>
    </x-slot>

    <x-slot name="content">
        <x-jet-validation-errors> </x-jet-validation-errors>

        <x-form-section action="{{ route('subcategory.update', ['id' => $subcategory->id]) }}">
            <x-slot name="content">
                {{-- Tutył --}}
                <x-jet-label for="name" class="pl-2"> Nazwa kategorii: </x-jet-label>
                <x-jet-input name="name" value="{{ old('name', $subcategory->name) }}" type="text"
                    class="border px-2 min-w-full mb-3">
                </x-jet-input>

                @error('name')
                    <div class="simple-error">{{ $message }}</div>
                @enderror

                <div class="relative">
                    <x-jet-label for="image_url" class="pl-2"> Obrazek: </x-jet-label>
                    <x-jet-input name="image_url" value="{{ old('image_url', $subcategory->image_url) }}" type="text"
                        class="border px-2 min-w-full mb-3" id="image_url">
                    </x-jet-input>

                    {{-- <img src="{{ URL::asset('/images/paste.png') }}" alt="profile Pic" height="20" width="20" class="bg-gray-100 absolute right-1 bottom-1 hover:cursor-pointer" title="Wklej obrazek nadrzędnej podkategorii"> --}}
                </div>

                @error('image_url')
                    <div class="simple-error">{{ $message }}</div>
                @enderror

                <div class="mb-2">
                    Czy podkategoria ma być publiczna?
                    <input type="checkbox" name="public" @if ($subcategory->public) checked @endif>
                </div>

                <x-jet-button type="submit">Zapisz</x-jet-button>
            </x-slot>
        </x-form-section>

        {{-- <script src="{{ mix('js/pasteImg.js') }}"></script> --}}

        <x-delete-item-button action="{{ route('subcategory.delete', ['id' => $subcategory->id, 'view' => $view]) }}">
        </x-delete-item-button>

        <x-back-button action="{{ route('category.show', ['id' => $subcategory->category_id, 'view' => $view]) }}">
        </x-back-button>
    </x-slot>
</x-main-layout>
