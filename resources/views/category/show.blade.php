<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->name }}
        </h2>

        <x-back-button-upper action="{{ route('category.list', ['view' => 'visible']) }}">
        </x-back-button-upper>
    </x-slot>

    <x-slot name="content">
        <div class="flex flex-wrap text-center py-2">
            <a href="{{ route('subcategory.create', ['category_id' => $category->id, 'view' => $view]) }}"
                class="w-2/4 border-r-2">
                Dodaj podkategorię
            </a>
            <a href="{{ route('page.create', ['type' => 'category', 'parent_id' => $category->id, 'view' => $view]) }}"
                class="w-2/4">
                Dodaj stronę
            </a>
        </div>
        {{-- Podkategorie --}}
        <div>
            <x-items-header basic="{{ route('category.show', ['id' => $category->id, 'view' => 'visible']) }}"
                hidden="{{ route('category.show', ['id' => $category->id, 'view' => 'hidden']) }}"
                all="{{ route('category.show', ['id' => $category->id, 'view' => 'all']) }}">

                <x-slot name="header"> Podkategorie </x-slot>
            </x-items-header>

            <div class="flex flex-wrap px-1">
                @foreach ($subcategories as $subcategory)
                    <x-item hidden="{{ $subcategory->hidden }}">
                        <x-slot name="title">{{ $subcategory->name }}</x-slot>
                        <x-slot name="content">
                            <a
                                href="{{ route('subcategory.show', ['id' => $subcategory->id, 'view' => 'visible']) }}">
                                <img src="{{ $subcategory->image_url }}" alt="Obrazek" class="full">
                            </a>

                        </x-slot>

                        <x-slot name="changeVisibility">
                            {{ route('subcategory.changeVisibility', ['id' => $subcategory->id]) }}
                        </x-slot>

                        <x-slot name="settings">
                            {{ route('subcategory.edit', ['id' => $subcategory->id, 'view' => $view]) }}
                        </x-slot>
                    </x-item>
                @endforeach
            </div>
        </div>
        {{-- Strony --}}
        <div class="pb-10">
            <x-items-header basic="{{ route('category.show', ['id' => $category->id, 'view' => 'visible']) }}"
                hidden="{{ route('category.show', ['id' => $category->id, 'view' => 'hidden']) }}"
                all="{{ route('category.show', ['id' => $category->id, 'view' => 'all']) }}">

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

                        <x-slot name="changeVisibility">
                            {{ route('page.changeVisibility', ['id' => $page->id]) }}
                        </x-slot>

                        <x-slot name="settings">
                            {{ route('page.edit', ['id' => $page->id, 'type' => 'category', 'view' => $view]) }}
                        </x-slot>
                    </x-item>
                @endforeach
            </div>
        </div>
    </x-slot>
</x-main-layout>
