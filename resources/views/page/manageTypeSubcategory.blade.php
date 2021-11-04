<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Zarządzaj stronami') }}
        </h2>
    </x-slot>

    <x-manage.main>
        <x-form-section action="{{ route('update.pages', ['type' => 'subcategory']) }}">
            <table class="w-full">
                <x-manage.table-head.page name="Nazwa kategorii"></x-manage.table-head.page>

                <tbody>
                    <tr>
                        <td colspan="4"></td>
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
                                <td colspan="7" class="font-bold border-t-2 border-blue-600">{{ $category->name }}
                                </td>
                            </tr>

                            @foreach ($category->subcategories as $subcategory)
                                @if (count($subcategory->pages) != 0)
                                    <tr>
                                        <td colspan="7" class="font-bold pl-4">{{ $subcategory->name }}</td>
                                    </tr>
                                    @foreach ($subcategory->pages as $item)
                                        <tr class="border-b">
                                            <td class="pl-8">{{ $item->name }}</td>

                                            <td class="text-center">
                                                <div class="char minus"></div>
                                            </td>

                                            <td class="text-center">
                                                <div class="lh-order">
                                                    <input type="number" value="{{ $item->order }}"
                                                        class="order" name="order[]">
                                                </div>
                                            </td>

                                            <td class="text-center">
                                                <div class="char plus"></div>
                                            </td>


                                            <td class="text-center">
                                                <input name="hidden[{{ $index }}]" type="hidden" value="0">
                                                <input name="hidden[{{ $index }}]" type="checkbox" value="1"
                                                    class="hiddenCheckbox" @if ($item->hidden) checked @endif>

                                            </td>
                                            <td class="text-center">
                                                <input name="public[{{ $index }}]" type="hidden" value="0">
                                                <input name="public[{{ $index }}]" type="checkbox" value="1"
                                                    class="publicCheckbox" @if (!$item->public) checked @endif>
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
</x-main-layout>



<script>
    initCheckboxButton('public');
    initCheckboxButton('hidden');
    initCheckboxButton('open');
    initOrder();
</script>
