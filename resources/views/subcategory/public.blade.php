<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $subcategory->name }}
        </h2>

        @if ($subcategory->category->private == false)
            <x-back-button-upper action="{{ route('category.public', ['id' => $subcategory->category_id]) }}">
            </x-back-button-upper>
        @endif
    </x-slot>

    <x-items.body>
        <x-slot name="header">
            <x-items.header>
                Strony
            </x-items.header>
        </x-slot>

        <x-slot name="items">
            @foreach ($subcategory->pages as $item)
                @if ($item->private == false)
                    <x-item.body>
                        <x-item.title>{{ $item->name }}</x-item.title>
                        <x-item.image route="{{ $item->link }}" image="{{ $item->image_url }}"></x-item.image>
                    </x-item.body>
                @endif
            @endforeach
        </x-slot>
    </x-items.body>
</x-main-layout>
