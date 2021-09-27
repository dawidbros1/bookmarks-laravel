<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $subcategory->name }}
        </h2>

        <x-back-button-upper action="{{ route('category.show', ['id' => $subcategory->category_id]) }}">
        </x-back-button-upper>

        {{-- @auth
        <x-back-button-upper action="{{ route('category.list') }}">
        </x-back-button-upper>
        @endauth
        @endif --}}
    </x-slot>

    <x-slot name="content">
        {{-- @if ($author) --}}
        <div class="flex flex-wrap text-center py-2">
            <a href="{{ route('page.create', ['type' => 'subcategory', 'parent_id' => $subcategory->id]) }}"
                class="w-full">
                Dodaj stronę
            </a>
        </div>
        {{-- @endif --}}

        @if ($pages->first() != null)
            <div class="pb-10">
                <x-items-header>
                    <x-slot name="header"> Strony </x-slot>
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
                                {{-- @if ($author) --}}
                                {{ route('page.edit', ['id' => $page->id, 'type' => 'subcategory']) }}
                                {{-- @endif --}}
                            </x-slot>
                        </x-item>
                    @endforeach
                </div>
            </div>
        @endif
    </x-slot>
</x-main-layout>
