<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Moje kategorie') }}
        </h2>
    </x-slot>

    <x-slot name="content">
        <div>
            <div class="flex flex-wrap px-1">
                @foreach ($categories as $category)
                    <x-item>
                        <x-slot name="title">{{ $category->name }}</x-slot>
                        <x-slot name="content">

                            <a href="{{ route('category.show', ['id' => $category->id]) }}">
                                <img src="{{ $category->image_url }}" alt="Obrazek" class="full">
                            </a>

                        </x-slot>
                        <x-slot name="routeToSettings">
                            {{ route('category.edit', ['id' => $category->id]) }}
                        </x-slot>
                    </x-item>
                @endforeach
            </div>
        </div>
    </x-slot>
</x-main-layout>
