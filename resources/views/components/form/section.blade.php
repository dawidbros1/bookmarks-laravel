<x-jet-validation-errors> </x-jet-validation-errors>

<form method="POST" action="{{ $attributes['action'] }}" {{ $attributes->merge(['class' => 'p-4']) }}>
    @csrf

    {{ $slot }}
</form>
