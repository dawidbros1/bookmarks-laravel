<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Zarządzaj kategoriami') }}
        </h2>
    </x-slot>

    <x-slot name="content">
        <x-manage.main>
            <x-form-section action="{{ route('update.categories.checkboxes') }}">
                <table class="w-full">
                    <thead>
                        <th class="text-left w-4/6 md:w-9/12 lg:w-10/12">Nazwa kategorii</th>
                        <th>Ukryta</th>
                        <th>Publiczna</th>
                    </thead>

                    <tbody>
                        <tr class="border-b-2 border-blue-600">
                            <td></td>
                            <td class="text-center"><input type="checkbox" id="hiddenCheckboxButton"></td>
                            <td class="text-center"><input type="checkbox" id="publicCheckboxButton"></td>
                        </tr>

                        @foreach ($categories as $key => $category)
                            <tr class="border-b">
                                <td>{{ $category->name }}</td>
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
    </x-slot>


</x-main-layout>



<script>
    initCheckboxButton('public');
    initCheckboxButton('hidden');
</script>
