<div class="mb-2 px-1 box-border w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/9">
    <div class="w-full h-40 bg-gray-100 relative overflow-hidden">

        <h3 class="text-purple-300 font-bold mb-1 text-center h-5 overflow-hidden px-1">
            {{ $title }}
        </h3>

        {{ $content }}

        @if ($changeVisibility != '')
            <div class="h-auto">
                @if ($attributes['hidden'])
                    <a href="{{ $changeVisibility }}" class="absolute left-1 bottom-1" title="Odkryj element">
                        <img src="{{ URL::asset('/images/hidden.png') }}" alt="changeVisibility Pic" height="20"
                            width="20" class="bg-gray-100">
                    </a>
                @else
                    <a href="{{ $changeVisibility }}" class="absolute left-1 bottom-1" title="Ukryj element">
                        <img src="{{ URL::asset('/images/block.png') }}" alt="changeVisibility Pic" height="20"
                            width="20" class="bg-gray-100">
                    </a>
                @endif
            </div>
        @endif

        @if ($settings != '')
            <div class="h-auto">
                <a href="{{ $settings }}" class="absolute right-1 bottom-1">
                    <img src="{{ URL::asset('/images/settings.png') }}" alt="settings Pic" height="20" width="20"
                        class="bg-gray-100">
                </a>
            </div>
        @endif
    </div>
</div>
