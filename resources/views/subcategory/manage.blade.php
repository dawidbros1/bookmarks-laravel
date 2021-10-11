<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Zarządzaj podkategoriami') }}
        </h2>
    </x-slot>

    <x-slot name="content">
        <x-manage.main>

            <x-form-section action="{{ route('update.subcategories.checkboxes') }}">
                <table class="w-full">
                    <thead>
                        <th class="text-left w-10/12 lg:w-11/12">Nazwa kategorii</th>
                        <th></th>
                        <th>
                            <img class="block m-auto" src="{{ URL::asset('/images/block.png') }}" alt="profile Pic"
                                height="25" width="25" title="Czy element ma być widoczny" )>
                        </th>
                        <th>
                            <img class="block m-auto" src="{{ URL::asset('/images/open_lock.png') }}"
                                alt="profile Pic" height="25" width="25" title="Czy element ma być publiczny" )>
                        </th>
                    </thead>

                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-center"><input type="checkbox" id="hiddenCheckboxButton"></td>
                            <td class="text-center"><input type="checkbox" id="publicCheckboxButton"></td>
                        </tr>

                        @php
                            $index = 0;
                        @endphp

                        @foreach ($categories as $category)


                            @if (count($category->subcategories) != 0)

                                @php
                                    $key = key($category);
                                @endphp

                                <tr class="border-t-2 border-blue-600 font-bold">
                                    <td colspan="4">{{ $category->name }}</td>
                                </tr>
                                @foreach ($category->subcategories as $item)
                                    <tr class="border-b">

                                        <td class="pl-4">{{ $item->name }}</td>

                                        <x-manage.table-column-image-link
                                            link="{{ route('manage.subcategory.pages', ['id' => $item->id]) }}"
                                            image_name="page.png">
                                        </x-manage.table-column-image-link>

                                        <td class="text-center">
                                            <input name="hidden[{{ $index }}]" type="hidden" value="0">
                                            <input name="hidden[{{ $index }}]" type="checkbox" value="1"
                                                class="hiddenCheckbox" @if ($item->hidden) checked @endif>
                                        </td>
                                        <td class="text-center">
                                            <input name="public[{{ $index }}]" type="hidden" value="0">
                                            <input name="public[{{ $index++ }}]" type="checkbox" value="1"
                                                class="publicCheckbox" @if ($item->public) checked @endif>
                                        </td>
                                    </tr>
                                    <input type="hidden" name="ids[]" value="{{ $item->id }}">
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>

                <x-jet-button type="submit" class="mt-2">Zapisz</x-jet-button>
            </x-form-section>

        </x-manage.main>
    </x-slot>


</x-main-layout>



<script>
    initCheckboxButton('public');
    initCheckboxButton('hidden');
</script>
