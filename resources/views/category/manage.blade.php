<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Zarządzaj kategoriami') }}
        </h2>
    </x-slot>

    @if (count($categories) > 0)

    <x-form-section action="{{ route('category.manage') }}">
        <table class="w-full">
            <thead>
                <th class="text-left w-8/12 md:w-9/12 xl:w-10/12">Nazwa kategorii</th>
                <th></th>
                <x-manage.table-th type="position"></x-manage.table-th>
                <th colspan="3"></th>
                <x-manage.table-th type="hidden"></x-manage.table-th>
                <x-manage.table-th type="private"></x-manage.table-th>
            </thead>

            <tbody>
                <tr class="border-b-2 border-blue-600">
                    <td colspan="6"></td>
                    <td class="text-center"><input type="checkbox" id="hiddenCheckboxButton"></td>
                    <td class="text-center"><input type="checkbox" id="privateCheckboxButton"></td>
                </tr>

                @foreach ($categories as $key => $category)
                <tr class="border-b">

                    <td>
                        {{ $category->name }}
                    </td>

                    <x-manage.sorting position="{{ $category->position }}"></x-manage.sorting>

                    <td>
                        <a class="text-blue-400" href="{{ route('category.manage.subcategories', ['id' => $category->id]) }}">
                            <img class="block m-auto" src="{{ URL::asset('/images/folder.png') }}" alt="profile Pic" height="20" width="20" )>
                        </a>
                    </td>

                    <td>
                        <a class="text-blue-400" href="{{ route('category.manage.pages', ['id' => $category->id]) }}">
                            <img class="block m-auto" src="{{ URL::asset('/images/page.png') }}" alt="profile Pic" height="20" width="20" )>
                        </a>
                    </td>

                    <td class="text-center">
                        <input name="hidden[{{ $key }}]" type="hidden" value="0">
                        <input name="hidden[{{ $key }}]" type="checkbox" value="1" class="hiddenCheckbox" @if ($category->hidden) checked @endif>
                    </td>

                    <td class="text-center">
                        <input name="private[{{ $key }}]" type="hidden" value="0">
                        <input name="private[{{ $key }}]" type="checkbox" value="1" class="privateCheckbox" @if ($category->private) checked @endif>
                    </td>
                </tr>
                <input type="hidden" name="ids[]" value="{{ $category->id }}">
                @endforeach
            </tbody>
        </table>
        <x-jet-button type="submit" class="mt-2">Zapisz</x-jet-button>
    </x-form-section>
    @endif
</x-main-layout>

<script>
    initCheckboxButton('private');
    initCheckboxButton('hidden');
    initSort();

</script>
