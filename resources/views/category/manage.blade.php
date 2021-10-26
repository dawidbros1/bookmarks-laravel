<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Zarządzaj kategoriami') }}
        </h2>
    </x-slot>

    <x-manage.main>
        <x-form-section action="{{ route('update.categories.checkboxes') }}">
            <table class="w-full">
                <thead>
                    <th class="text-left w-9/12 lg:w-10/12 xl:w-11/12">Nazwa kategorii</th>
                    <th></th>
                    <th></th>
                    <th>
                        <img class="block m-auto" src="{{ URL::asset('/images/block.png') }}" alt="profile Pic"
                            height="25" width="25" title="Czy element ma być widoczny" )>
                    </th>
                    <th>
                        <img class="block m-auto" src="{{ URL::asset('/images/open_lock.png') }}" alt="profile Pic"
                            height="25" width="25" title="Czy element ma być publiczny" )>
                    </th>
                </thead>

                <tbody>
                    <tr class="border-b-2 border-blue-600">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center"><input type="checkbox" id="hiddenCheckboxButton"></td>
                        <td class="text-center"><input type="checkbox" id="publicCheckboxButton"></td>
                    </tr>

                    @foreach ($categories as $key => $category)
                        <tr class="border-b">
                            <td>
                                {{ $category->name }}
                            </td>

                            <x-manage.table-column-image-link
                                link="{{ route('manage.category.subcategories', ['id' => $category->id]) }}"
                                image_name="folder.png">
                            </x-manage.table-column-image-link>

                            <x-manage.table-column-image-link
                                link="{{ route('manage.category.pages', ['id' => $category->id]) }}"
                                image_name="page.png">
                            </x-manage.table-column-image-link>

                            <td class="text-center">
                                <input name="hidden[{{ $key }}]" type="hidden" value="0">
                                <input name="hidden[{{ $key }}]" type="checkbox" value="1"
                                    class="hiddenCheckbox" @if ($category->hidden) checked @endif>
                            </td>
                            <td class="text-center">
                                <input name="public[{{ $key }}]" type="hidden" value="0">
                                <input name="public[{{ $key }}]" type="checkbox" value="1"
                                    class="publicCheckbox" @if ($category->public) checked @endif>
                            </td>
                        </tr>
                        <input type="hidden" name="ids[]" value="{{ $category->id }}">
                    @endforeach
                </tbody>
            </table>

            <x-jet-button type="submit" class="mt-2">Zapisz</x-jet-button>

        </x-form-section>
    </x-manage.main>
</x-main-layout>



<script>
    initCheckboxButton('public');
    initCheckboxButton('hidden');
</script>
