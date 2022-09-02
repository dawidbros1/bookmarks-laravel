<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Wszystkie kategorie') }}
        </h2>
    </x-slot>

    <x-items.body>
        <x-slot name="header">
            <x-items.header visibility={{$visibility}} visible="{{ route('category.list') }}"
                hidden="{{ route('category.list', ['visibility' => 1]) }}" manage="{{ route('category.manage') }}">
                Kategorie
            </x-items.header>
        </x-slot>

        @php $index = 0; @endphp

        <x-slot name="items">
            @foreach ($categories as $item)
                <x-item.body>
                    <x-item.title>{{ $item->name }}</x-item.title>
                    <x-item.image route="{{ route('category.show', ['id' => $item->id]) }}"
                        image="{{ $item->image_url }}">
                    </x-item.image>

                    <x-item.settings
                        route="{{ route('category.edit', ['id' => $item->id, 'visibility' => $visibility]) }}">
                    </x-item.settings>

                    <x-item.change-visibility hidden="{{ $item->hidden }}"
                        route="{{ route('category.changeVisibility', ['id' => $item->id, 'visibility' => $visibility]) }}">
                    </x-item.change-visibility>

                    @if ($item->private == false)
                        <x-item.share index="{{ $index++ }}"
                            link="{{ route('category.public', ['id' => $item->id]) }}">
                        </x-item.share>
                    @endif
                </x-item.body>
            @endforeach
        </x-slot>
    </x-items.body>
</x-main-layout>
