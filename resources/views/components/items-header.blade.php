<div class="block max-w-full bg-green-400 text-center mb-2 relative py-1">
    <p>{{ $header }}</p>

    <a class="absolute right-24 top-1 border-2 border-indigo-600" href="{{ $attributes['basic'] }}">
        <img src="{{ URL::asset('/images/block.png') }}" alt="unhidden Pic" height="20" width="20"
            class="bg-gray-100">
    </a>

    <a class="absolute right-16 top-1 border-2 border-indigo-600" href="{{ $attributes['hidden'] }}">
        <img src="{{ URL::asset('/images/hidden.png') }}" alt="hidden Pic" height="20" width="20"
            class="bg-gray-100">
    </a>

    <a class="absolute right-2 top-1 flex d-flex-wrap border-2 border-indigo-600" href="{{ $attributes['all'] }}">
        <img src="{{ URL::asset('/images/block.png') }}" alt="all Pic" height="20" width="20" class="bg-gray-100">
        <img src="{{ URL::asset('/images/hidden.png') }}" alt="all Pic" height="20" width="20" class="bg-gray-100">
    </a>
</div>
