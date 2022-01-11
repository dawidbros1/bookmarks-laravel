<td class="text-center">
    <input name="{{ $attributes['name'] }}[{{ $attributes['index'] }}]" type="hidden" value="0">
    <input name="{{ $attributes['name'] }}[{{ $attributes['index'] }}]" type="checkbox" value="1"
        class="{{ $attributes['name'] }}Checkbox" @if ($attributes['checked']) checked @endif>
</td>
