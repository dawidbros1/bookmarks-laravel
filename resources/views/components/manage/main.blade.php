<div class="md:flex flex-col md:flex-row">
    <div class="flex flex-col md:w-64 text-gray-700">
        <div class="px-8 py-4 text-lg font-semibold tracking-widest uppercase">
            Wybierz
        </div>
        <nav class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">
            <x-manage.link route="{{ route('category.manage') }}" :active="request()->routeIs('category.manage')">
                Kategorie</x-manage.link>
            <x-manage.link route="{{ route('subcategory.manage') }}"
                :active="request()->routeIs('subcategory.manage')">
                Podkategorie</x-manage.link>
            <x-manage.link route="{{ route('category.manage') }}" :active="request()->routeIs('page.manage')">
                Strony</x-manage.link>
        </nav>
    </div>

    <div class="w-full">
        {{ $slot }}
    </div>

</div>
