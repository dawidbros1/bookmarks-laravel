<div class="mb-2 px-1 box-border w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/9">
    <div class="w-full h-40 bg-gray-100 relative overflow-hidden">

        <h3 class="text-purple-300 font-bold mb-1 text-center h-5 overflow-hidden px-1">
            {{ $title }}
        </h3>

        {{ $content }}


        @if ($routeToSettings != '')
            <div class="h-auto">
                <a href="{{ $routeToSettings }}" class="absolute right-1 bottom-1">
                    <img src="{{ URL::asset('/images/settings.png') }}" alt="profile Pic" height="20" width="20"
                        class="bg-gray-100">
                </a>
            </div>
        @endif
    </div>
</div>
