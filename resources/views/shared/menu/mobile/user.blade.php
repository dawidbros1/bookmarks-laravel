<!-- Responsive Navigation Menu -->
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    @auth
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('news') }}" :active="request()->routeIs('news')">
                {{ __('Aktualności') }}
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pb-1 pt-2 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div>
                    {{-- <div class="font-medium text-sm text-gray-500">Konto</div> --}}
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div>
                <div class="flex items-center mt-4 px-4">
                    <div class="font-medium text-sm text-gray-500">Kategorie</div>
                </div>

                <x-jet-responsive-nav-link href="{{ route('category.list') }}"
                    :active="request()->routeIs('category.list')" class="py-1">
                    {{ __('Moje kategorie') }}
                </x-jet-responsive-nav-link>

                <x-jet-responsive-nav-link href="{{ route('category.create') }}"
                    :active="request()->routeIs('category.create')" class="py-1">
                    {{ __('Dodaj kategorie') }}
                </x-jet-responsive-nav-link>

            </div>

            <div class="mt-3">
                <div class="flex items-center mt-4 px-4">
                    <div class="font-medium text-sm text-gray-500">Konto</div>
                </div>

                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')"
                    class="py-1">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    this.closest('form').submit();" class="py-1">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>
            </div>
        </div>
    @endauth
</div>
