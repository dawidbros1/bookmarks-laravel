<!-- Responsive Navigation Menu -->
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <div class="pb-1 pt-2 border-t border-gray-200">
        <div>
            <div class="flex items-center mt-4 px-4">
                <div class="font-medium text-sm text-gray-500">Konto</div>
            </div>

            <x-jet-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')"
                class="py-1">
                {{ __('Rejestracja') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')" class="py-1">
                {{ __('Logowanie') }}
            </x-jet-responsive-nav-link>
        </div>
    </div>
</div>
