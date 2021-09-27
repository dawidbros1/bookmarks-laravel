@if ($errors->any())
    <div {{ $attributes }} class="mb-5 border">
        <div role="alert">
            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                Przesłanie formularza nie powiodło się
            </div>

            @foreach ($errors->all() as $error)
                <div class="bg-red-100 text-red-700 px-4 py-1 relative" role="alert">
                    <span class="block sm:inline"> {{ $error }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3"></span>
                </div>
            @endforeach
        </div>
    </div>
@endif
