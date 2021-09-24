<a href="{{ $attributes['action'] }}">
    <x-jet-button type="submit"
        {{ $attributes->merge(['class' => 'bg-green-400 hover:bg-green-500 absolute right-2 top-0 mt-1 w-max pt-2 pb-2']) }}>
        Powrót
    </x-jet-button>
</a>
