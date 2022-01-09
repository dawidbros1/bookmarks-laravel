<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edycja kategorii') }}
        </h2>
    </x-slot>

    <x-jet-validation-errors> </x-jet-validation-errors>

    <x-form-section action="{{ route('category.edit', ['id' => $category->id]) }}">
        <x-form.input name="name" value="{{ $category->name }}">Nazwa: </x-form.input>
        <x-form.input name="image_url" value="{{  $category->image_url  }}">Adres obrazka: </x-form.input>

        <x-form.checkbox name="private" checked="{{ $category->private }}"> Czy kategoria ma być prywatna? </x-form.checkbox>

        <x-jet-button type="submit">Zapisz</x-jet-button>
    </x-form-section>

    <x-delete-item-button action="{{ route('category.delete', ['id' => $category->id, 'visibility' => $visibility]) }}"></x-delete-item-button>
    <x-back-button action="{{ route('category.list', ['visibility' => $visibility]) }}"></x-back-button>
</x-main-layout>
