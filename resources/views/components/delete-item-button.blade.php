<div x-data="{ open: false }">
    <x-jet-button @click="open = ! open"
        {{ $attributes->merge(['class' => 'bg-red-500 absolute right-28 bottom-0']) }}>
        <div :class="{'hidden':  open, 'block': ! open }">USUŃ</div>
        <div :class="{'hidden': ! open, 'block': open }">UKRYJ</div>
    </x-jet-button>

    <div :class="{'hidden': ! open, 'block': open }"
        class="border-2 border-red-600 full-center w-3/4 lg:w-2/4 2xl:w-1/4 bg-gray-100 relative p-2">
        <div class="p-2">Czy jesteś pewny, ze chcesz usunąć ten element? </div>

        <x-form-section action="{{ $attributes['action'] }}">
            <x-slot name="content">
                <input type="hidden" name="_method" value="DELETE">
                <x-jet-button type="submit" class="bg-red-500 absolute right-28 bottom-1 px-2 py-1">Tak
                </x-jet-button>
            </x-slot>
        </x-form-section>

        <x-jet-button @click="open = ! open" type="submit" class="bg-red-500 absolute right-2 bottom-1 px-2 py-1">
            Nie
        </x-jet-button>
    </div>
</div>
