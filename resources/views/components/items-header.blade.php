<div class="block max-w-full bg-green-400 text-center mb-2 relative py-1">
    <p>{{ $header }}</p>

    @if ($attributes['basic'] != null)
    <a class="icon icon-visible" href="{{ $attributes['basic'] }}" title="Pokaż tylko widoczne">
        <img src="{{ URL::asset('/images/block.png') }}" alt="unhidden Pic" class="bg-gray-100">
    </a>

    <a class="icon icon-hidden" href="{{ $attributes['hidden'] }}" title="Pokaż tylko ukryte">
        <img src="{{ URL::asset('/images/hidden.png') }}" alt="hidden Pic" class="bg-gray-100">
    </a>

    <a class="icon manage" href="{{ $attributes['manage'] }}" title="Pokaż tylko ukryte">
        Zarządzaj
    </a>
    @endif
</div>
