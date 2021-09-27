<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Katalog główny') }}
        </h2>
    </x-slot>

    <x-slot name="content">
        <div>
            <x-items-header basic="{{ route('category.list') }}"
                hidden="{{ route('category.list', ['show' => 'hidden']) }}"
                all="{{ route('category.list', ['show' => 'all']) }}">

                <x-slot name="header"> Moje kategorie </x-slot>
            </x-items-header>

            <div class="flex flex-wrap px-1">
                @foreach ($categories as $category)
                    <x-item hidden="{{ $category->hidden }}">
                        <x-slot name="title">{{ $category->name }}</x-slot>
                        <x-slot name="content">

                            <a href="{{ route('category.show', ['id' => $category->id]) }}">
                                <img src="{{ $category->image_url }}" alt="Obrazek" class="full">
                            </a>

                        </x-slot>

                        <x-slot name="changeVisibility">
                            {{ route('category.changeVisibility', ['id' => $category->id]) }}
                        </x-slot>

                        <x-slot name="settings">
                            {{ route('category.edit', ['id' => $category->id]) }}
                        </x-slot>
                    </x-item>
                @endforeach
            </div>
        </div>
    </x-slot>
</x-main-layout>
