<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Zarządzaj podkategorią') }}
        </h2>
    </x-slot>

    <x-form-section action="{{ route('subcategory.manage') }}">
        <table class="w-full">
            <thead>
                <th class="text-left w-8/12 md:w-9/12 xl:w-10/12">{{ $category->name }}</th>
                <th></th>
                <x-manage.table-th type="position"></x-manage.table-th>
                <th></th>
                <th></th>
                <x-manage.table-th type="hidden"></x-manage.table-th>
                <x-manage.table-th type="private"></x-manage.table-th>
            </thead>

            <tbody>
                <tr class="border-b-2 border-blue-600">
                    <td colspan="5"></td>
                    <td class="text-center"><input type="checkbox" id="hiddenCheckboxButton"></td>
                    <td class="text-center"><input type="checkbox" id="privateCheckboxButton"></td>
                </tr>

                @php $index = 0; @endphp

                @foreach ($category->subcategories as $item)
                <tr class="border-t">
                    <td class="pl-4">{{ $item->name }}</td>

                    <x-manage.sorting position="{{ $item->position }}"></x-manage.sorting>

                    <td>
                        <a class="text-blue-400" href="{{ route('subcategory.manage.pages', ['id' => $item->id]) }}">
                            <img class="block m-auto" src="{{ URL::asset('/images/page.png') }}" alt="profile Pic" height="20" width="20" )>
                        </a>
                    </td>

                    <td class="text-center">
                        <input name="hidden[{{ $index }}]" type="hidden" value="0">
                        <input name="hidden[{{ $index }}]" type="checkbox" value="1" class="hiddenCheckbox" @if ($item->hidden) checked @endif>
                    </td>

                    <td class="text-center">
                        <input name="private[{{ $index }}]" type="hidden" value="0">
                        <input name="private[{{ $index++ }}]" type="checkbox" value="1" class="privateCheckbox" @if ($item->private) checked @endif>
                    </td>
                </tr>
                <input type="hidden" name="ids[]" value="{{ $item->id }}">
                @endforeach
            </tbody>
        </table>

        <x-jet-button type="submit" class="mt-2">Zapisz</x-jet-button>
    </x-form-section>
</x-main-layout>

<script>
    initCheckboxButton('hidden');
    initCheckboxButton('private');
    initSort();

</script>
