<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->name }}
        </h2>
    </x-slot>


    <div>
        <x-items-header>
            <x-slot name="header"> Podkategorie </x-slot>
        </x-items-header>

        <div class="flex flex-wrap px-1">
            @foreach ($subcategories as $subcategory)
                <x-item hidden="{{ $subcategory->hidden }}">
                    <x-slot name="title">{{ $subcategory->name }}</x-slot>
                    <x-slot name="content">
                        <a href="{{ route('subcategory.public', ['id' => $subcategory->id]) }}">
                            <img src="{{ $subcategory->image_url }}" alt="Obrazek" class="full">
                        </a>
                    </x-slot>

                    <x-slot name="changeVisibility"></x-slot>
                    <x-slot name="settings"></x-slot>
                </x-item>
            @endforeach
        </div>
    </div>
    {{-- Strony --}}
    <div class="pb-10">
        <x-items-header>
            <x-slot name="header"> Strony </x-slot>
        </x-items-header>

        <div class="flex flex-wrap px-1">
            @foreach ($pages as $page)
                <x-item hidden="{{ $page->hidden }}">
                    <x-slot name="title">{{ $page->name }}</x-slot>
                    <x-slot name="content">
                        <a href="{{ $page->link }}" target="_blank">
                            <img src="{{ $page->image_url }}" alt="Obrazek" class="full">
                        </a>
                    </x-slot>

                    <x-slot name="changeVisibility"></x-slot>
                    <x-slot name="settings"></x-slot>
                </x-item>
            @endforeach
        </div>
    </div>
</x-main-layout>
