<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->name }}
        </h2>

        <x-back-button-upper action="{{ route('category.list', ['visibility' => 'visible']) }}">
        </x-back-button-upper>
    </x-slot>

    <div class="flex flex-wrap text-center py-2">
        <a href="{{ route('subcategory.create', ['category_id' => $category->id, 'visibility' => $visibility]) }}"
            class="w-2/4 border-r-2">
            Dodaj podkategorię
        </a>
        <a href="{{ route('page.create', ['parent' => 'category', 'id' => $category->id, 'visibility' => $visibility]) }}"
            class="w-2/4">
            Dodaj stronę
        </a>
    </div>
    <div>
        <x-item.header visible="{{ route('category.show', ['id' => $category->id]) }}"
            hidden="{{ route('category.show', ['id' => $category->id, 'visibility' => 1]) }}"
            manage="{{ route('category.manage.subcategories', ['id' => $category->id]) }}">Podkategorie
        </x-item.header>

        <?php $index = 0; ?>

        <div class="flex flex-wrap px-1">
            @foreach ($category->subcategories ?? [] as $subcategory)
                <?php if ($subcategory->hidden != $visibility) {
                    continue;
                } ?>

                <x-item hidden="{{ $subcategory->hidden }}">
                    <x-slot name="title">{{ $subcategory->name }}</x-slot>
                    <x-slot name="content">
                        <a
                            href="{{ route('subcategory.show', ['id' => $subcategory->id, 'visibility' => 'visible']) }}">
                            <img src="{{ $subcategory->image_url }}" alt="Obrazek" class="full">
                        </a>

                        {{-- Pobranie linku do udostępnienia --}}
                        <div class="bg-gray-100 hover:cursor-pointer absolute right-1 bottom-8">

                            @if ($subcategory->public)
                                <img src="{{ URL::asset('/images/paste.png') }}" alt="profile Pic" height="20"
                                    width="20" title="Skopiuj link do udostępnienia"
                                    onclick="copyToClipBoard({{ $index++ }})">
                            @endif

                            <input type="hidden" class="copy"
                                value="{{ route('subcategory.public', ['id' => $subcategory->id]) }}">
                        </div>
                    </x-slot>

                    <x-slot name="changeVisibility">
                        {{ route('subcategory.changeVisibility', ['id' => $subcategory->id]) }}
                    </x-slot>

                    <x-slot name="settings">
                        {{ route('subcategory.edit', ['id' => $subcategory->id, 'visibility' => $visibility]) }}
                    </x-slot>
                </x-item>
            @endforeach
        </div>
    </div>
    {{-- Strony --}}
    <div class="pb-10">
        <x-items-header basic="{{ route('category.show', ['id' => $category->id, 'visibility' => '0']) }}"
            hidden="{{ route('category.show', ['id' => $category->id, 'visibility' => '1']) }}"
            manage="{{ route('category.manage.pages', ['id' => $category->id]) }}">

            <x-slot name="header"> Strony </x-slot>
        </x-items-header>

        <div class="flex flex-wrap px-1">
            @foreach ($category->pages ?? [] as $page)
                <?php if ($page->hidden != $visibility) {
                    continue;
                } ?>

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
                        {{ route('page.edit', ['id' => $page->id, 'type' => 'category', 'visibility' => $visibility]) }}
                    </x-slot>
                </x-item>
            @endforeach
        </div>
    </div>
</x-main-layout>
