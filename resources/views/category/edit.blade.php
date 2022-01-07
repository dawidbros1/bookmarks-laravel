<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edycja kategorii') }}
        </h2>
    </x-slot>

    <x-jet-validation-errors> </x-jet-validation-errors>

    <x-form-section action="{{ route('category.edit', ['id' => $category->id]) }}">
        {{-- Tutył --}}
        <x-jet-label for="name" class="pl-2"> Nazwa: </x-jet-label>
        <x-jet-input name="name" value="{{ old('name', $category->name) }}" type="text"
            class="border px-2 min-w-full mb-3">
        </x-jet-input>

        @error('name')
            <div class="simple-error">{{ $message }}</div>
        @enderror

        {{-- Obrazek --}}
        <x-jet-label for="image_url" class="pl-2"> Obrazek: </x-jet-label>
        <x-jet-input name="image_url" value="{{ old('image_url', $category->image_url) }}" type="text"
            class="border px-2 min-w-full mb-3">
        </x-jet-input>

        @error('image_url')
            <div class="simple-error">{{ $message }}</div>
        @enderror

        <div class="mb-2">
            Czy kategoria ma być publiczna?
            <input type="checkbox" name="public" @if ($category->public) checked @endif>
        </div>

        <x-jet-button type="submit">Zapisz</x-jet-button>
    </x-form-section>

    <x-delete-item-button action="{{ route('category.delete', ['id' => $category->id, 'visibility' => $visibility]) }}">
    </x-delete-item-button>
    <x-back-button action="{{ route('category.list', ['visibility' => $visibility]) }}"></x-back-button>

</x-main-layout>
