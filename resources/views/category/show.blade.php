<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->name }}
        </h2>

        <x-buttons.back type="upper" route="{{ route('category.list', ['visibility' => 'visible']) }}">
        </x-buttons.back>
    </x-slot>

    <div class="flex flex-wrap text-center py-2">
        <a href="{{ route('subcategory.create', ['category_id' => $category->id, 'visibility' => $visibility]) }}"
            class="w-2/4 border-r-2">
            Dodaj podkategorię
        </a>
        <a href="{{ route('page.create', ['type' => 'category', 'id' => $category->id, 'visibility' => $visibility]) }}"
            class="w-2/4">
            Dodaj stronę
        </a>
    </div>

    {{-- Podkategorie --}}
    <x-items.body>
        <x-slot name="header">
            <x-items.header visible="{{ route('category.show', ['id' => $category->id]) }}"
                hidden="{{ route('category.show', ['id' => $category->id, 'visibility' => 1]) }}"
                manage="{{ route('category.manage.subcategories', ['id' => $category->id]) }} ">
                Podkategorie
            </x-items.header>
        </x-slot>

        @php $index = 0; @endphp

        <x-slot name="items">
            @foreach ($category->subcategories as $item)
                @if ($item->hidden == $visibility)
                    <x-item.body>
                        <x-item.title>{{ $item->name }}</x-item.title>
                        <x-item.image route="{{ route('subcategory.show', ['id' => $item->id]) }}"
                            image="{{ $item->image_url }}">
                        </x-item.image>

                        <x-item.settings
                            route="{{ route('subcategory.edit', ['id' => $item->id, 'visibility' => $visibility]) }}">
                        </x-item.settings>

                        <x-item.change-visibility hidden="{{ $item->hidden }}"
                            route="{{ route('subcategory.changeVisibility', ['id' => $item->id, 'visibility' => $visibility]) }}">
                        </x-item.change-visibility>

                        @if ($item->private == false)
                            <x-item.share index="{{ $index++ }}"
                                link="{{ route('subcategory.public', ['id' => $item->id]) }}">
                            </x-item.share>
                        @endif
                    </x-item.body>
                @endif
            @endforeach
        </x-slot>
    </x-items.body>

    {{-- Strony --}}
    <x-items.body>
        <x-slot name="header">
            <x-items.header visible="{{ route('category.show', ['id' => $category->id]) }}"
                hidden="{{ route('category.show', ['id' => $category->id, 'visibility' => 1]) }}"
                manage="{{ route('category.manage.pages', ['id' => $category->id]) }}">
                Strony
            </x-items.header>
        </x-slot>

        <x-slot name="items">
            @foreach ($category->pages as $item)
                @if ($item->hidden == $visibility)
                    <x-item.body>
                        <x-item.title>{{ $item->name }}</x-item.title>
                        <x-item.image route="{{ $item->link }}" image="{{ $item->image_url }}"></x-item.image>

                        <x-item.settings
                            route="{{ route('page.edit', ['id' => $item->id, 'visibility' => $visibility]) }}">
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
