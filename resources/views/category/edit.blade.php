<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edycja kategorii') }}
        </h2>
    </x-slot>

    <x-form.section action="{{ route('category.edit', ['id' => $category->id]) }}">
        <x-form.input name="name" value="{{ $category->name }}">Nazwa: </x-form.input>
        <x-form.input name="image_url" value="{{ $category->image_url }}">Adres obrazka: </x-form.input>

        <x-form.checkbox name="private" checked="{{ $category->private }}"> Czy kategoria ma być prywatna?
        </x-form.checkbox>

        <x-form.button>Edytuj</x-form.button>
    </x-form.section>

    <x-buttons.item-delete
        route="{{ route('category.delete', ['id' => $category->id, 'visibility' => $visibility]) }}">
    </x-buttons.item-delete>

    <x-back-button route="{{ route('category.list', ['visibility' => $visibility]) }}"></x-back-button>
</x-main-layout>
