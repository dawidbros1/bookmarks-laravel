<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Zarządzaj podkategorią') }}
        </h2>

        <x-buttons.back type="upper" route="{{ route('category.show', ['id' => $category->id]) }}">
        </x-buttons.back>
    </x-slot>

    @if (count($category->subcategories) > 0)
        <x-form.section action="{{ route('subcategory.manage') }}">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left w-8/12 md:w-9/12 xl:w-10/12">{{ $category->name }}</th>
                        <x-manage.table-th colspan="3" image="position"></x-manage.table-th>
                        <th></th>
                        <x-manage.table-th image="hidden"></x-manage.table-th>
                        <x-manage.table-th image="lock"></x-manage.table-th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="border-b-2 border-blue-600">
                        <td colspan="5"></td>
                        <td class="text-center"><input type="checkbox" id="hiddenCheckboxButton"></td>
                        <td class="text-center"><input type="checkbox" id="privateCheckboxButton"></td>
                    </tr>

                    @foreach ($category->subcategories as $index => $item)
                        <tr class="border-t">
                            <td class="pl-4">{{ $item->name }}</td>
                            <x-manage.sorting position="{{ $item->position }}"></x-manage.sorting>

                            <x-manage.icon name="page"
                                route="{{ route('subcategory.manage.pages', ['id' => $item->id]) }}">
                            </x-manage.icon>

                            <x-manage.checkbox name="hidden" index="{{ $index }}"
                                checked="{{ $item->hidden }}">
                            </x-manage.checkbox>

                            <x-manage.checkbox name="private" index="{{ $index }}"
                                checked="{{ $item->private }}">
                            </x-manage.checkbox>
                        </tr>
                        <input type="hidden" name="ids[]" value="{{ $item->id }}">
                    @endforeach
                </tbody>
            </table>
            <x-jet-button type="submit" class="mt-2">Zapisz</x-jet-button>
        </x-form.section>
    @else
        <p class="text-center font-bold mt-5 text-xl"> Brak danych do wyświetlenia</p>
    @endif
</x-main-layout>

<script>
    initCheckboxButton('hidden');
    initCheckboxButton('private');
    initSort();
</script>
