<?php $name =  $attributes['name'] ?? "" ?>
<?php $input =  $attributes['value'] ?? "" ?>

<?php $value = old($name, $input) ?>

<x-jet-label for="{{ $name }}" class="pl-2"> {{ $slot }} </x-jet-label>
<x-jet-input name="{{ $name }}" value="{{ $value }}" type="text" class="border px-2 min-w-full mb-3"></x-jet-input>

@error($name)
<div class="simple-error">{{ $message }}</div>
@enderror