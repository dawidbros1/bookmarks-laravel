<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Wszystkie kategorie') }}
        </h2>
    </x-slot>
    <div>
        <x-items-header basic="{{ route('category.list', ['view' => 'visible']) }}"
            hidden="{{ route('category.list', ['view' => 'hidden']) }}"
            all="{{ route('category.list', ['view' => 'all']) }}">

            <x-slot name="header"> Moje kategorie </x-slot>
        </x-items-header>

        <div class="flex flex-wrap px-1">
            @foreach ($categories as $category)
                <x-item hidden="{{ $category->hidden }}">
                    <x-slot name="title">{{ $category->name }}</x-slot>
                    <x-slot name="content">
                        <a href="{{ route('category.show', ['id' => $category->id, 'view' => 'visible']) }}">
                            <img src="{{ $category->image_url }}" alt="Obrazek" class="full">
                        </a>

                        {{-- Pobranie linku do udostępnienia --}}
                        <div class="bg-gray-100 hover:cursor-pointer absolute right-1 bottom-8">
                            <img src="{{ URL::asset('/images/paste.png') }}" alt="profile Pic" height="20" width="20"
                                title="Skopiuj link do udostępnienia" onclick="copyToClipBoard({{ $loop->index }})">

                            <input type="hidden" class="copy"
                                value="{{ route('category.public', ['id' => $category->id]) }}">
                        </div>
                    </x-slot>

                    <x-slot name="changeVisibility">
                        {{ route('category.changeVisibility', ['id' => $category->id]) }}
                    </x-slot>

                    <x-slot name="settings">
                        {{ route('category.edit', ['id' => $category->id, 'view' => $view]) }}
                    </x-slot>
                </x-item>
            @endforeach
        </div>
    </div>

</x-main-layout>
