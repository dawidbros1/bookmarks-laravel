<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edytuj stronę') }}
        </h2>
    </x-slot>

    <x-jet-validation-errors> </x-jet-validation-errors>

    <x-form-section action="{{ route('page.edit', ['id' => $page->id]) }}">
        {{-- Tutył --}}
        <x-jet-label for="name" class="pl-2"> Nazwa: </x-jet-label>
        <x-jet-input name="name" value="{{ old('name', $page->name) }}" type="text" class="border px-2 min-w-full mb-3">
        </x-jet-input>

        @error('name')
        <div class="simple-error">{{ $message }}</div>
        @enderror

        {{-- Obrazek --}}
        <div class="relative">
            <x-jet-label for="image_url" class="pl-2"> Obrazek: </x-jet-label>
            <x-jet-input name="image_url" value="{{ old('image_url', $page->image_url) }}" type="text" class="border px-2 min-w-full mb-3" id="image_url">
            </x-jet-input>

            {{-- <img src="{{ URL::asset('/images/paste.png') }}" alt="profile Pic" height="20" width="20" class="bg-gray-100 absolute right-1 bottom-1 hover:cursor-pointer" title="Wklej obrazek podkategorii" onclick="pasteImg('{{ $parent->image_ult }}');"> --}}
        </div>

        @error('image_url')
        <div class=" simple-error">{{ $message }}
        </div>
        @enderror

        {{-- Obrazek --}}
        <x-jet-label for="link" class="pl-2"> Link do strony: </x-jet-label>
        <x-jet-input name="link" value="{{ old('link', $page->link) }}" type="text" class="border px-2 min-w-full mb-3">
        </x-jet-input>

        @error('link')
        <div class="simple-error">{{ $message }}</div>
        @enderror

        {{-- EDYCJA ROZMIESZCZENIA --}}

        <p class="font-bold">Zaawansowane</p>

        <div class="mb-2">
            Kategoria główna
            <select name="category_id" id="select-category" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                @foreach ($categories as $category)
                <option data-id="{{ $category->id }}" value="{{ $category->id }}" @if ($category->id == $category_id) selected @endif>
                    {{ $category->name }} </option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            Umieść w
            <select name="subcategory_id" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                <option value="0" id="default">Wybranej kategorii</option>
                @foreach ($subcategories as $subcategory)
                <option class="subcategory-option @if ($subcategory->category_id != $category_id) hidden @endif" @if ($page->type == 'subcategory' && $page->parent_id == $subcategory->id) selected @endif
                    data-category-id="
                    {{ $subcategory->category_id }}" value="{{ $subcategory->id }}">
                    {{ $subcategory->name }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- KONIEC EDYCJI ROZMIESZCZENIA --}}

        <div class="mb-2">
            Czy strona ma być publiczna?
            <input type="checkbox" name="public" @if ($page->public) checked @endif>
        </div>

        <x-jet-button type="submit" class="ml-2">Zapisz</x-jet-button>
    </x-form-section>

    <x-delete-item-button action="{{ route('page.delete', ['id' => $page->id, 'visibility' => $visibility]) }}">
    </x-delete-item-button>

    <x-back-button action="{{ route($page->type . '.show', ['id' => $page->parent_id, 'visibility' => $visibility]) }}">
    </x-back-button>

    <script src="{{ mix('js/pageEdit.js') }}"></script>
</x-main-layout>
