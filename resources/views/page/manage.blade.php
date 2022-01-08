<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Zarządzaj stronami' }}
        </h2>
    </x-slot>

    @if (count($parent->pages) > 0)
    <x-form-section action="{{ route('page.manage', ['type' => $type]) }}">
        <table class="w-full">

            <thead>
                <th class="text-left w-8/12 md:w-9/12 xl:w-10/12">{{ $parent->name }}</th>
                <th></th>
                <x-manage.table-th type="order"></x-manage.table-th>
                <th></th>
                <x-manage.table-th type="hidden"></x-manage.table-th>
                <x-manage.table-th type="public"></x-manage.table-th>
            </thead>

            <tbody>
                <tr class="border-b-2 border-blue-600">
                    <td colspan="4"></td>
                    <td class="text-center"><input type="checkbox" id="hiddenCheckboxButton"></td>
                    <td class="text-center"><input type="checkbox" id="publicCheckboxButton"></td>
                </tr>

                @php $index = 0; @endphp

                @foreach ($parent->pages as $item)
                <tr class="border-b">
                    <td class="pl-4">{{ $item->name }}</td>

                    <td class="text-center">
                        <div class="char minus"></div>
                    </td>

                    <td class="text-center">
                        <div class="lh-order">
                            <input type="number" value="{{ $item->order }}" class="order" name="order[]">
                        </div>
                    </td>

                    <td class="text-center">
                        <div class="char plus"></div>
                    </td>

                    <td class="text-center">
                        <input name="hidden[{{ $index }}]" type="hidden" value="0">
                        <input name="hidden[{{ $index }}]" type="checkbox" value="1" class="hiddenCheckbox" @if ($item->hidden) checked @endif>

                    </td>
                    <td class="text-center">
                        <input name="public[{{ $index }}]" type="hidden" value="0">
                        <input name="public[{{ $index++ }}]" type="checkbox" value="1" class="publicCheckbox" @if (!$item->public) checked @endif>
                    </td>
                    </td>
                </tr>
                <input type="hidden" name="ids[]" value="{{ $item->id }}">
                @endforeach
            </tbody>
        </table>

        <x-jet-button type="submit" class="mt-2">Zapisz</x-jet-button>
    </x-form-section>
    @endif
</x-main-layout>

<script>
    initCheckboxButton('public');
    initCheckboxButton('hidden');
    initOrder();

</script>
