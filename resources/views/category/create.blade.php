<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dodaj kategorie') }}
        </h2>
    </x-slot>

    <x-form.section action="{{ route('category.create') }}">
        <x-form.input name="name">Nazwa: </x-form.input>
        <x-form.input name="image_url">Adres obrazka: </x-form.input>

        <x-form.checkbox name="private"> Czy kategoria ma być prywatna? </x-form.checkbox>

        <x-form.button>Zapisz</x-form.button>
    </x-form.section>

    <x-back-button action=" {{ route('category.list') }}"></x-back-button>
</x-main-layout>
