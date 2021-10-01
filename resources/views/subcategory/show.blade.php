<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $subcategory->name }}
        </h2>

        <x-back-button-upper
            action="{{ route('category.show', ['id' => $subcategory->category_id, 'view' => $view]) }}">
        </x-back-button-upper>
    </x-slot>

    <x-slot name="content">
        <div class="flex flex-wrap text-center py-2">
            <a href="{{ route('page.create', ['type' => 'subcategory', 'parent_id' => $subcategory->id, 'view' => $view]) }}"
                class="w-full">
                Dodaj stronę
            </a>
        </div>

        <div class="pb-10">
            <x-items-header basic="{{ route('subcategory.show', ['id' => $subcategory->id, 'view' => 'visible']) }}"
                hidden="{{ route('subcategory.show', ['id' => $subcategory->id, 'view' => 'hidden']) }}"
                all="{{ route('subcategory.show', ['id' => $subcategory->id, 'view' => 'all']) }}">

                <x-slot name="header"> Strony </x-slot>
            </x-items-header>

            <div class="flex flex-wrap px-1">
                @foreach ($pages as $page)
                    <x-item hidden="{{ $page->hidden }}">
                        <x-slot name="title">{{ $page->name }}</x-slot>
                        <x-slot name="content">
                            <a href="{{ $page->link }}" @php
                                if ($page->open_in_new_window) {
                                    echo `target="_blank"`;
                                }
                            @endphp>>
                                <img src="{{ $page->image_url }}" alt="Obrazek" class="full">
                            </a>
                        </x-slot>

                        <x-slot name="changeVisibility">
                            {{ route('page.changeVisibility', ['id' => $page->id]) }}
                        </x-slot>

                        <x-slot name="settings">
                            {{ route('page.edit', ['id' => $page->id, 'type' => 'subcategory', 'view' => $view]) }}
                        </x-slot>
                    </x-item>
                @endforeach
            </div>
        </div>

    </x-slot>
</x-main-layout>
