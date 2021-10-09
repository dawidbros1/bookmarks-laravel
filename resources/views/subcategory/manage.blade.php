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
                        <th class="text-left w-4/6 md:w-9/12 lg:w-10/12">Nazwa</th>
                        <th>Ukryta</th>
                        <th>Publiczna</th>
                    </thead>

                    <tbody>
                        <tr>
                            <td></td>
                            <td class="text-center"><input type="checkbox" id="hiddenCheckboxButton"></td>
                            <td class="text-center"><input type="checkbox" id="publicCheckboxButton"></td>
                        </tr>

                        @php
                            $index = 0;
                        @endphp

                        @foreach ($categories as $key => $category)
                            @if (count($category->subcategories) != 0)
                                <tr class="border-t-2 border-blue-600">
                                    <td colspan="3" class="font-bold">{{ $category->name }}</td>
                                </tr>
                                @foreach ($category->subcategories as $item)
                                    <tr class="border-b">
                                        <td class="pl-4">{{ $item->name }}</td>
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
