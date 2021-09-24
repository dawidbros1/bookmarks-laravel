<div class="block max-w-full bg-green-400 text-center mb-2 relative py-1">
    <p>{{ $title }}</p>

    @if ($attributes['author'])
        <a class="absolute right-2 top-1 border px-1 bg-green-500 text-white" href="{{ $attributes['action'] }}">Zmień
            kolejność</a>
    @endif
</div>
