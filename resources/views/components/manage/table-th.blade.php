<?php $image = $attributes['image'] ?? ''; ?>
<?php $colspan = $attributes['colspan'] ?? 1; ?>
<th colspan="{{ $colspan }}">
    <img class="block m-auto" src="{{ URL::asset('/images/' . $image . '.png') }}" alt="profile Pic" height="25"
        width="25" title="Nazwa">
</th>
