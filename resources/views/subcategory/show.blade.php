<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $subcategory->name }}
        </h2>

        <x-buttons.back type="upper"
            route="{{ route('category.show', ['id' => $subcategory->category_id, 'visibility' => $visibility]) }}">
        </x-buttons.back>
    </x-slot>

    <div class="flex flex-wrap text-center py-2">
        <a href="{{ route('page.create', ['type' => 'subcategory', 'id' => $subcategory->id, 'visibility' => $visibility]) }}"
            class="w-full">
            Dodaj stronę
        </a>
    </div>

    {{-- Strony --}}
    <x-items.body>
        <x-slot name="header">
            <x-items.header visible="{{ route('subcategory.show', ['id' => $subcategory->id]) }}"
                hidden="{{ route('subcategory.show', ['id' => $subcategory->id, 'visibility' => 1]) }}"
                manage="{{ route('subcategory.manage.pages', ['id' => $subcategory->id]) }}">
                Strony
            </x-items.header>
        </x-slot>

        <x-slot name="items">
            @foreach ($subcategory->pages as $item)
                @if ($item->hidden == $visibility)
                    <x-item.body>
                        <x-item.title>{{ $item->name }}</x-item.title>
                        <x-item.image route="{{ $item->link }}" image="{{ $item->image_url }}"></x-item.image>

                        <x-item.settings
                            route="{{ route('page.edit', ['id' => $item->id, 'visibility' => $visibility, 'type' => 'subcategory']) }}">
                        </x-item.settings>

                        <x-item.change-visibility hidden="{{ $item->hidden }}"
                            route="{{ route('page.changeVisibility', ['id' => $item->id, 'visibility' => $visibility]) }}">
                        </x-item.change-visibility>
                    </x-item.body>
                @endif
            @endforeach
        </x-slot>
    </x-items.body>
</x-main-layout>
