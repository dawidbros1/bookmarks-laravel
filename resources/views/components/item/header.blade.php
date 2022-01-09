<?php $visible = $attributes['visible'] ?? null; ?>
<?php $hidden = $attributes['hidden'] ?? null; ?>
<?php $manage = $attributes['manage'] ?? null; ?>

<div class="block max-w-full bg-green-400 text-center mb-2 relative py-1">
    <p>{{ $slot }}</p>

    @if ($visible != null)

        <a class="icon icon-visible" href="{{ $visible }}" title="Pokaż tylko widoczne">
            <img src="{{ URL::asset('/images/block.png') }}" alt="#" class="bg-gray-100">
        </a>

        <a class="icon icon-hidden" href="{{ $hidden }}" title="Pokaż tylko ukryte">
            <img src="{{ URL::asset('/images/hidden.png') }}" alt="#" class="bg-gray-100">
        </a>

        <a class="icon manage" href="{{ $manage }}">Zarządzaj</a>

    @endif
</div>
