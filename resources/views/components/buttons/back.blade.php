<a href="{{ $attributes['route'] }}" class="block w-full">
    <x-jet-button type="submit"
        {{ $attributes->merge(['class' => 'bg-green-400 hover:bg-green-500 absolute right-4 bottom-4']) }}>
        Powrót
    </x-jet-button>
</a>
