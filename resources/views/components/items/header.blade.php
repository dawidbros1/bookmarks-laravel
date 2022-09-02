<?php $visible = $attributes['visible'] ?? null;?>
<?php $hidden = $attributes['hidden'] ?? null;?>
<?php $manage = $attributes['manage'] ?? null;?>
<?php $visibility = $attributes['visibility'];?>

<p>{{ $slot }}</p>

@if ($visible != null)
    <a class="icon icon-visible {{ $visibility == 0 ? 'icon-selected' : ''  }} " href="{{ $visible }}" title="Pokaż tylko widoczne">
        <img src="{{ URL::asset('/images/block.png') }}" alt="#" class="bg-gray-100">
    </a>

    <a class="icon icon-hidden {{ $visibility == 1 ? 'icon-selected' : ''  }} " href="{{ $hidden }}" title="Pokaż tylko ukryte">
        <img src="{{ URL::asset('/images/hidden.png') }}" alt="#" class="bg-gray-100">
    </a>

    <a class="icon manage" href="{{ $manage }}">Zarządzaj</a>
@endif
