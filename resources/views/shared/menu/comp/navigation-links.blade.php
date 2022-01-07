<div class="flex">
    <!-- Logo -->
    <div class="flex-shrink-0 flex items-center">
        <a href="{{ route('news') }}">
            <x-jet-application-mark class="block h-9 w-auto" />
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="hidden sm:flex sm:items-center sm:ml-6">
        <div class="ml-3 relative">
            @auth
                <x-jet-nav-link href="{{ route('news') }}" :active="request()->routeIs('news')">Aktualności
                </x-jet-nav-link>

                <x-jet-nav-link href="{{ route('category.list') }}"
                    :active="request()->routeIs('category.list')">Moje
                    kategorie
                </x-jet-nav-link>

                <x-jet-nav-link href="{{ route('category.create') }}" :active="request()->routeIs('category.create')">
                    Dodaj kategorie
                </x-jet-nav-link>

                <x-jet-nav-link href="{{ route('manage.categories') }}" :active="request()->routeIs('manage.categories')">
                    Zarządzaj
                </x-jet-nav-link>
            @endauth
        </div>
    </div>
</div>
