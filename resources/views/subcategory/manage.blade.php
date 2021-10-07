<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Zarządzaj podkategoriami') }}
        </h2>
    </x-slot>

    <x-slot name="content">
        <x-manage.main>

            <x-form-section action="{{ route('subcategory.manageUpdate') }}">
                <table class="w-full">
                    <thead>
                        <th class="text-left w-4/6 md:w-9/12 lg:w-10/12">Nazwa</th>
                        <th>Ukryta</th>
                        <th>Publiczna</th>
                    </thead>

                    <tbody>
                        <tr class="border-b-2">
                            <td></td>
                            <td class="text-center"><input type="checkbox" id="hiddenCheckboxButton"></td>
                            <td class="text-center"><input type="checkbox" id="publicCheckboxButton"></td>
                        </tr>

                        @php
                            $key = 0;
                        @endphp

                        @foreach ($categories as $category)

                            @if (count($category->subcategory) != 0)
                                <tr>
                                    <td colspan="3" class="font-bold">{{ $category->name }}</td>
                                </tr>

                                @foreach ($category->subcategory as $subcategory)
                                    <tr class="border-b-2">
                                        <td class="pl-4">{{ $subcategory->name }}</td>
                                        <td class="text-center">
                                            <input name="hidden[{{ $key }}]" type="hidden" value="0">
                                            <input name="hidden[{{ $key }}]" type="checkbox" value="1"
                                                class="hiddenCheckbox" @if ($subcategory->hidden) checked @endif>
                                        </td>
                                        <td class="text-center">
                                            <input name="public[{{ $key }}]" type="hidden" value="0">
                                            <input name="public[{{ $key++ }}]" type="checkbox" value="1"
                                                class="publicCheckbox" @if ($subcategory->public) checked @endif>
                                        </td>
                                    </tr>
                                    <input type="hidden" name="ids[]" value="{{ $subcategory->id }}">
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
