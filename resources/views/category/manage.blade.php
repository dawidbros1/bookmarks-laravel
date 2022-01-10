<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Zarządzaj kategoriami') }}
        </h2>
    </x-slot>

    @if (count($categories) > 0)

        <x-form.section action="{{ route('category.manage') }}">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left w-8/12 md:w-9/12 xl:w-10/12">Nazwa kategorii</th>
                        <x-manage.table-th colspan="3" image="position"></x-manage.table-th>
                        <th colspan="2"></th>
                        <x-manage.table-th image="hidden"></x-manage.table-th>
                        <x-manage.table-th image="lock"></x-manage.table-th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="border-b-2 border-blue-600">
                        <td colspan="6"></td>
                        <td class="text-center"><input type="checkbox" id="hiddenCheckboxButton"></td>
                        <td class="text-center"><input type="checkbox" id="privateCheckboxButton"></td>
                    </tr>

                    @foreach ($categories as $index => $item)
                        <tr class="border-b">
                            <td> {{ $category->name }} </td>
                            <x-manage.sorting position="{{ $item->position }}"></x-manage.sorting>

                            <x-manage.icon name="folder"
                                route="{{ route('category.manage.subcategories', ['id' => $item->id]) }}">
                            </x-manage.icon>

                            <x-manage.icon name="page"
                                route="{{ route('category.manage.pages', ['id' => $item->id]) }}">
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
    @endif
</x-main-layout>

<script>
    initCheckboxButton('private');
    initCheckboxButton('hidden');
    initSort();
</script>
