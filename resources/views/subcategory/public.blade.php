<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $subcategory->name }}
        </h2>

        @if ($subcategory->category->public == 1)
        <x-back-button-upper action="{{ route('category.public', ['id' => $subcategory->category_id]) }}">
        </x-back-button-upper>
        @endif
    </x-slot>

    <div class="pb-10">
        <x-items-header>
            <x-slot name="header"> Strony </x-slot>
        </x-items-header>

        <div class="flex flex-wrap px-1">
            @foreach ($subcategory->pages ?? [] as $page)

            <?php if ($page->public == 0) continue ?>

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
