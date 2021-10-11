<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Zarządzaj stronami') }}
        </h2>
    </x-slot>

    <x-slot name="content">
        <x-manage.main>

            <x-form-section action="{{ route('update.pages.checkboxes', ['type' => 'subcategory']) }}">
                <table class="w-full">
                    <thead>
                        <th class="text-left w-9/12 md:w-9/12 lg:w-10/12">Nazwa kategorii</th>
                        <th>
                            <img class="block m-auto" src="{{ URL::asset('/images/block.png') }}" alt="profile Pic"
                                height="25" width="25" title="Czy element ma być widoczny" )>
                        </th>
                        <th>
                            <img class="block m-auto" src="{{ URL::asset('/images/open_lock.png') }}"
                                alt="profile Pic" height="25" width="25" title="Czy element ma być publiczny" )>
                        </th>
                        <th>
                            <img class="block m-auto" src="{{ URL::asset('/images/open_in_new_window.png') }}"
                                alt="profile Pic" height="25" width="25"
                                title="Czy strona ma otworzyć się w nowym oknie" )>
                        </th>
                    </thead>

                    <tbody>
                        <tr>
                            <td></td>
                            <td class="text-center"><input type="checkbox" id="hiddenCheckboxButton"></td>
                            <td class="text-center"><input type="checkbox" id="publicCheckboxButton"></td>
                            <td class="text-center"><input type="checkbox" id="openCheckboxButton"></td>
                        </tr>

                        @php
                            $index = 0;
                        @endphp

                        @foreach ($categories as $category)
                            @if (count($category->subcategories) != 0)
                                <tr>
                                    <td colspan="4" class="font-bold border-t-2 border-blue-600">{{ $category->name }}
                                    </td>
                                </tr>

                                @foreach ($category->subcategories as $subcategory)
                                    @if (count($subcategory->pages) != 0)
                                        <tr>
                                            <td colspan="4" class="font-bold pl-4">{{ $subcategory->name }}</td>
                                        </tr>
                                        @foreach ($subcategory->pages as $item)
                                            <tr class="border-b">
                                                <td class="pl-8">{{ $item->name }}</td>
                                                <td class="text-center">
                                                    <input name="hidden[{{ $index }}]" type="hidden" value="0">
                                                    <input name="hidden[{{ $index }}]" type="checkbox" value="1"
                                                        class="hiddenCheckbox" @if ($item->hidden) checked @endif>

                                                </td>
                                                <td class="text-center">
                                                    <input name="public[{{ $index }}]" type="hidden" value="0">
                                                    <input name="public[{{ $index }}]" type="checkbox" value="1"
                                                        class="publicCheckbox" @if ($item->public) checked @endif>
                                                </td>

                                                <td class="text-center">
                                                    <input name="open[{{ $index }}]" type="hidden" value="0">
                                                    <input name="open[{{ $index++ }}]" type="checkbox" value="1"
                                                        class="openCheckbox" @if ($item->open_in_new_window) checked @endif>
                                                </td>
                                            </tr>
                                            <input type="hidden" name="ids[]" value="{{ $item->id }}">
                                        @endforeach
                                    @endif
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
    initCheckboxButton('open');
</script>
