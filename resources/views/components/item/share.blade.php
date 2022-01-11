<div class="bg-gray-100 hover:cursor-pointer absolute right-1 bottom-8">
    <img src="{{ URL::asset('/images/paste.png') }}" alt="profile Pic" height="20" width="20"
        title="Skopiuj link do udostępnienia" onclick="copyToClipBoard({{ $attributes['index'] }})">
    <input type="hidden" class="copy" value="{{ $attributes['link'] }}">
</div>
