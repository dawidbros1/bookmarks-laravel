<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Navigation [COMP] START -->
            @include('shared/menu/comp/navigation-links')

            {{-- USER SECTION => UPPER RIGHT CORNER --}}
            @auth
                @include('shared/menu/comp/user')
            @endauth

            @guest
                @include('shared/menu/comp/guest')
            @endguest

            <!-- Navigation [COMP] END -->

            <!-- Hamburger Mobile-->
            @include('shared/menu/mobile/hamburger')
        </div>
    </div>

    <!-- Navigation [MOBLIE] -->

    @auth
        @include('shared/menu/mobile/user')
    @endauth

    @guest
        @include('shared/menu/mobile/guest')
    @endguest
</nav>
