<div class="h-auto">
    @if ($attributes['hidden'])
        <a href="{{ $attributes['route'] }}" class="absolute left-1 bottom-1" title="Odkryj element">
            <img src="{{ URL::asset('/images/hidden.png') }}" alt="changeVisibility Pic" height="20" width="20"
                class="bg-gray-100">
        </a>
    @else
        <a href="{{ $attributes['route'] }}" class="absolute left-1 bottom-1" title="Ukryj element">
            <img src="{{ URL::asset('/images/block.png') }}" alt="changeVisibility Pic" height="20" width="20"
                class="bg-gray-100">
        </a>
    @endif
</div>
