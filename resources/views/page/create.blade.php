<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dodaj stronę') }}
        </h2>
    </x-slot>

    <x-jet-validation-errors> </x-jet-validation-errors>

    <x-form-section action="{{ route('page.create', ['parent' => $parent, 'id' => $id]) }}">
        <x-form.input name="name">Nazwa: </x-form.input>
        <x-form.input name="image_url">Adres obrazka: </x-form.input>
        <x-form.input name="link">Link do strony: </x-form.input>

        <x-form.checkbox name="private"> Czy strona ma być prywatna? </x-form.checkbox>

        <input type="hidden" name="type" value="{{ $parent }}">
        <input type="hidden" name="parent_id" value="{{ $id }}">

        <x-jet-button type="submit" class="ml-2">Zapisz</x-jet-button>
    </x-form-section>

    <x-back-button action="{{ route($parent . '.show', ['id' => $id, 'visibility' => $visibility]) }}">
    </x-back-button>
</x-main-layout>
