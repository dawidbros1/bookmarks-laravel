<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dodaj podkategorie') }}
        </h2>
    </x-slot>

    <x-form.section action="{{ route('subcategory.create', ['category_id' => $category->id]) }}">
        <x-form.input name="name">Nazwa: </x-form.input>
        <x-form.input name="image_url">Adres obrazka: </x-form.input>

        <x-form.checkbox name="private"> Czy podkategoria ma być prywatna? </x-form.checkbox>

        <x-jet-button type="submit">Zapisz</x-jet-button>
    </x-form.section>

    <x-back-button action="{{ route('category.show', ['id' => $category->id, 'visibility' => $visibility]) }}">
    </x-back-button>
</x-main-layout>
