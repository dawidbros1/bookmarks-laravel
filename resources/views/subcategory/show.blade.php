<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $subcategory->name }}
        </h2>

        <x-back-button-upper action="{{ route('category.show', ['id' => $subcategory->category_id, 'visibility' => $visibility]) }}">
        </x-back-button-upper>
    </x-slot>
    <div class="flex flex-wrap text-center py-2">
        <a href="{{ route('page.create', ['parent' => 'subcategory', 'id' => $subcategory->id, 'visibility' => $visibility]) }}" class="w-full">
            Dodaj stronę
        </a>
    </div>

    <div class="pb-10">
        <x-items-header basic="{{ route('subcategory.show', ['id' => $subcategory->id, 'visibility' => '0']) }}" hidden="{{ route('subcategory.show', ['id' => $subcategory->id, 'visibility' => '1']) }}" manage="{{ route('subcategory.manage.pages', ['id' => $subcategory->id]) }}">

            <x-slot name="header"> Strony </x-slot>
        </x-items-header>

        <div class="flex flex-wrap px-1">
            @foreach ($subcategory->pages ?? [] as $page)
            <?php if ($page->hidden != $visibility) continue ?>
            <x-item hidden="{{ $page->hidden }}">
                <x-slot name="title">{{ $page->name }}</x-slot>
                <x-slot name="content">
                    <a href="{{ $page->link }}">
                        <img src="{{ $page->image_url }}" alt="Obrazek" class="full">
                    </a>
                </x-slot>

                <x-slot name="changeVisibility">
                    {{ route('page.changeVisibility', ['id' => $page->id]) }}
                </x-slot>

                <x-slot name="settings">
                    {{ route('page.edit', ['id' => $page->id, 'type' => 'subcategory', 'visibility' => $visibility]) }}
                </x-slot>
            </x-item>
            @endforeach
        </div>
    </div>
</x-main-layout>
