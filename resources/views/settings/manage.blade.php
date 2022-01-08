<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ustawienia domyślne
        </h2>
    </x-slot>

    <x-manage.main>
        <div class="mt-5 md:col-span-2 px-2">
            <x-form-section action="{{ route('settings.manage') }}" class="p-0">
                <div class="px-4 py-5 bg-white sm:p-6 shadow">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="block col-span-12 sm:col-span-12">
                            <div class="mt-2">
                                <div>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox" name="category_public" @if ($settings->category_public) checked @endif>
                                        <span class="ml-2">Czy kategorie mają być publiczne?</span>
                                    </label>
                                </div>

                                <div>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox" name="subcategory_public" @if ($settings->subcategory_public) checked @endif>
                                        <span class="ml-2">Czy podkategorie ma być publiczne?</span>
                                    </label>
                                </div>

                                <div>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox" name="page_public" @if ($settings->page_public) checked @endif>
                                        <span class="ml-2">Czy strony mają być publiczne?</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:mt-0 md:col-span-2">
                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                        <button type="submit" class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition'>
                            Zapisz
                        </button>
                    </div>
                </div>
            </x-form-section>
        </div>
    </x-manage.main>
</x-main-layout>
