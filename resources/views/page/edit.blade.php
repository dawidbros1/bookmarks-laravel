<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edytuj stronę') }}
        </h2>
    </x-slot>

    <x-form.section action="{{ route('page.edit', ['id' => $page->id]) }}">
        <x-form.input name="name" value="{{ $page->name }}">Nazwa: </x-form.input>
        <x-form.input name="image_url" value="{{ $page->image_url }}">Adres obrazka: </x-form.input>
        <x-form.input name="link" value="{{ $page->link }}">Link do strony: </x-form.input>

        {{-- EDYCJA ROZMIESZCZENIA --}}

        <p class="font-bold">Zaawansowane</p>

        <div class="mb-2">
            Kategoria główna
            <select name="category_id" id="select-category" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                @foreach ($categories as $category)
                <option data-id="{{ $category->id }}" value="{{ $category->id }}" @if ($category->id == $category_id) selected @endif>
                    {{ $category->name }}
                </option>
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

        <x-form.checkbox name="private" checked="{{ $page->private }}"> Czy strona ma być prywatna?
        </x-form.checkbox>

        <x-form.button>Edytuj</x-form.button>
    </x-form.section>

    <x-buttons.item-delete route="{{ route('page.delete', ['id' => $page->id, 'visibility' => $visibility]) }}">
    </x-buttons.item-delete>

    <x-buttons.back route="{{ route($page->type . '.show', ['id' => $page->parent_id, 'visibility' => $visibility]) }}">
    </x-buttons.back>

    <script src="{{ mix('js/pageEdit.js') }}"></script>
</x-main-layout>