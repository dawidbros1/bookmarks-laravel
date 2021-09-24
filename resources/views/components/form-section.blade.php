<form method="POST" action="{{ $attributes['action'] }}" {{ $attributes->merge(['class' => 'p-4']) }}>
    @csrf



    {{ $content }}
</form>
