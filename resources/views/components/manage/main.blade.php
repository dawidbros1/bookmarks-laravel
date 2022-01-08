<x-jet-validation-errors> </x-jet-validation-errors>
<div class="md:flex flex-col md:flex-row">
    <div class="flex flex-col md:w-64 text-gray-700">
        <div class="px-8 py-4 text-lg font-semibold tracking-widest uppercase">
            Wybierz
        </div>
        <nav class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">
            <x-manage.link route="{{ route('settings.manage') }}" :active="request()->routeIs('settings.manage')">
                Ustawienia
            </x-manage.link>

            <x-manage.link route="{{ route('category.manage') }}" :active="request()->routeIs('category.manage')">
                Kategorie
            </x-manage.link>

            <x-manage.link route="{{ route('category.manage.pages', ['type' => 'category']) }}" :active="request()->routeIs('category.manage.pages')">
                <span class="ml-2">Strony</span>
            </x-manage.link>

            <x-manage.link route="{{ route('manage.subcategories') }}" :active="request()->routeIs('manage.subcategories')">
                Podkategorie
            </x-manage.link>

            <x-manage.link route="{{ route('manage.subcategories.pages', ['type' => 'subcategory']) }}" :active="request()->routeIs('manage.subcategories.pages')">
                <span class="ml-2">Strony</span>
            </x-manage.link>
        </nav>
    </div>

    <div class="w-full">
        {{ $slot }}
    </div>
</div>
