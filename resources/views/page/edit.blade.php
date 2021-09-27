<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edytuj stronę') }}
        </h2>
    </x-slot>

    <x-slot name="content">
        <x-jet-validation-errors> </x-jet-validation-errors>

        <x-form-section action="{{ route('page.update', ['id' => $page->id]) }}">
            <x-slot name="content">
                {{-- Tutył --}}
                <x-jet-label for="name" class="pl-2"> Nazwa strony: </x-jet-label>
                <x-jet-input name="name" value="{{ old('name', $page->name) }}" type="text"
                    class="border px-2 min-w-full mb-3">
                </x-jet-input>

                @error('name')
                    <div class="simple-error">{{ $message }}</div>
                @enderror

                {{-- Obrazek --}}

                <div class="relative">
                    <x-jet-label for="image_url" class="pl-2"> Obrazek: </x-jet-label>
                    <x-jet-input name="image_url" value="{{ old('image_url', $page->image_url) }}" type="text"
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
                <x-jet-input name="link" value="{{ old('link', $page->link) }}" type="text"
                    class="border px-2 min-w-full mb-3">
                </x-jet-input>

                @error('link')
                    <div class="simple-error">{{ $message }}</div>
                @enderror

                <div class="mb-2">
                    Czy strona ma być publiczna?
                    <input type="checkbox" name="public" @if ($page->public) checked @endif>
                </div>

                <x-jet-button type="submit" class="ml-2">Zapisz</x-jet-button>

            </x-slot>
        </x-form-section>

        <x-delete-item-button action="{{ route('page.delete', ['id' => $page->id]) }}">
        </x-delete-item-button>


        <x-back-button action="{{ route($page->type . '.show', ['id' => $page->parent_id]) }}">
        </x-back-button>


    </x-slot>
</x-main-layout>
