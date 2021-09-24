<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __($current_subcategory->name) }} --}}
        </h2>

        {{-- @if ($current_subcategory->parent_subcategory_id != 0)
        <x-back-button-upper action="{{ route('subcategory.list', ['id' => $current_subcategory->parent_subcategory_id]) }}">
        </x-back-button-upper>
        @else
        @auth
        <x-back-button-upper action="{{ route('category.list') }}">
        </x-back-button-upper>
        @endauth
        @endif --}}
    </x-slot>

    <x-slot name="content">
        {{-- @if ($author)
        <div class="flex flex-wrap text-center py-2">
            <a href="{{ route('subcategory.create', ['id' => $current_subcategory->id]) }}" class="w-2/4 border-r-2">
                Dodaj podkategorię
            </a>
            <a href="{{ route('page.create', ['subcategory_id' => $current_subcategory->id]) }}" class="w-2/4">
                Dodaj stronę
            </a>
        </div>
        @endif --}}

        {{-- @if ($subcategories->first() != null)
        <div>
            <x-items-header action="{{ route('subcategory.reorder', ['id' => $current_subcategory->id]) }}" author="{{ $author }}">
                <x-slot name="title">Kategorie</x-slot>
            </x-items-header>
            <div class="flex flex-wrap px-1">
                @foreach ($subcategories as $subcategory)
                <x-item>
                    <x-slot name="title">{{ $subcategory->name }}</x-slot>
                    <x-slot name="content">

                        <a href="{{ route('subcategory.list', ['id' => $subcategory->id]) }}">
                            <img src="{{ $subcategory->image_url }}" alt="Obrazek" class="full">
                        </a>

                    </x-slot>
                    <x-slot name="routeToSettings">
                        @if ($author)
                        {{ route('subcategory.edit', ['id' => $subcategory->id]) }}
                        @endif
                    </x-slot>
                </x-item>
                @endforeach
            </div>
        </div>
        @endif --}}

        {{-- @if ($pages->first() != null)
        <div class="pb-10">
            <x-items-header action="{{ route('page.reorder', ['subcategory_id' => $current_subcategory->id]) }}" author="{{ $author }}">
                <x-slot name="title">Strony</x-slot>
            </x-items-header>
            <div class="flex flex-wrap px-1">
                @foreach ($pages as $page)
                <x-item>
                    <x-slot name="title">{{ $page->name }}</x-slot>
                    <x-slot name="content">
                        <a href="{{ $page->link }}" target="_blank">
                            <img src="{{ $page->image_url }}" alt="Obrazek" class="full">
                        </a>
                    </x-slot>
                    <x-slot name="routeToSettings">
                        @if ($author)
                        {{ route('page.edit', ['id' => $page->id]) }}
                        @endif
                    </x-slot>
                </x-item>
                @endforeach
            </div>
        </div>
        @endif --}}
    </x-slot>
</x-main-layout>
