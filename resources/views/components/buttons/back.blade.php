<?php $type = $attributes['type'] ?? 'form'; ?>

<?php

if ($type == 'form') {
    $class = 'bg-green-400 hover:bg-green-500 absolute right-4 bottom-4';
} elseif ($type = 'upper') {
    $class = 'bg-green-400 hover:bg-green-500 absolute right-2 top-0 mt-1 w-max pt-2 pb-2';
}

?>

<a href="{{ $attributes['route'] }}">
    <x-jet-button type="submit" {{ $attributes->merge(['class' => $class]) }}>
        Powrót
    </x-jet-button>
</a>
