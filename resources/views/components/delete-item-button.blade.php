<div x-data="{ open: false }">
    <x-jet-button @click="open = ! open"
        {{ $attributes->merge(['class' => 'bg-red-500 absolute right-28 bottom-4']) }}>
        <div :class="{'hidden':  open, 'block': ! open }">USUŃ</div>
        <div :class="{'hidden': ! open, 'block': open }">UKRYJ</div>
    </x-jet-button>

    <div :class="{'hidden': ! open, 'block': open }"
        class="border-2 full-center w-3/4 lg:w-1/2 2xl:w-1/4 bg-gray-100 relative hidden">
        {{-- hidden --}}

        <div class="border-b-2 text-center font-bold">
            Komunikat ze strony
        </div>

        <div class="p-1 text-center">Czy jesteś pewny, ze chcesz usunąć ten element? </div>

        <x-form-section action="{{ $attributes['action'] }}">
            <x-slot name="content">
                <input type="hidden" name="_method" value="DELETE">
                <x-jet-button type="submit" class="bg-red-500 absolute right-14 bottom-1 px-2 py-1">Tak
                </x-jet-button>
            </x-slot>
        </x-form-section>

        <x-jet-button @click="open = ! open" type="submit" class="bg-green-500 absolute right-2 bottom-1 px-2 py-1">
            Nie
        </x-jet-button>
    </div>
</div>
