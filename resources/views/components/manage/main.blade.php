<div class="md:flex flex-col md:flex-row">
    <div class="flex flex-col md:w-64 text-gray-700">
        <div class="px-8 py-4 text-lg font-semibold tracking-widest uppercase">
            Wybierz
        </div>
        <nav class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">
            <x-manage.link route="{{ route('manage.categories') }}" :active="request()->routeIs('manage.categories')">
                Kategorie
            </x-manage.link>

            <x-manage.link route="{{ route('manage.category.pages', ['type' => 'category']) }}"
                :active="request()->routeIs('manage.category.pages')">
                <span class="ml-2">Strony</span>
            </x-manage.link>

            <x-manage.link route="{{ route('manage.subcategories') }}"
                :active="request()->routeIs('manage.subcategories')">
                Podkategorie
            </x-manage.link>

            <x-manage.link route="{{ route('manage.subcategory.pages', ['type' => 'subcategory']) }}"
                :active="request()->routeIs('manage.subcategory.pages')">
                <span class="ml-2">Strony</span>
            </x-manage.link>
        </nav>
    </div>

    <div class="w-full">
        {{ $slot }}
    </div>

</div>
