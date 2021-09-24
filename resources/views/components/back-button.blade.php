<a href="{{ $attributes['action'] }}" class="block w-full">
    <x-jet-button type="submit"
        {{ $attributes->merge(['class' => 'bg-green-400 hover:bg-green-500 absolute right-2 bottom-0']) }}>
        Powrót
    </x-jet-button>
</a>
