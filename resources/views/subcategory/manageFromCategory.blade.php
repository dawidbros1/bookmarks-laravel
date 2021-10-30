<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Zarządzaj podkategoriami' }}
        </h2>
    </x-slot>

    <x-manage.main>
        <x-form-section action="{{ route('update.subcategories') }}">
            <table class="w-full">
                <thead>
                    <th class="text-left w-8/12 md:w-9/12 xl:w-10/12">{{ $category->name }}</th>
                    <th></th>

                    <th>
                        <img class="block m-auto" src="{{ URL::asset('/images/order.png') }}" alt="profile Pic"
                            height="25" width="25" title="Kolejność wyświetlania" )>
                    </th>
                    <th colspan="2"></th>
                    <th>
                        <img class="block m-auto" src="{{ URL::asset('/images/hidden.png') }}" alt="profile Pic"
                            height="25" width="25" title="Czy element ma być ukryty" )>
                    </th>
                    <th>
                        <img class="block m-auto" src="{{ URL::asset('/images/lock.png') }}" alt="profile Pic"
                            height="25" width="25" title="Czy element ma być prywatny" )>
                    </th>
                </thead>

                <tbody>
                    <tr class="border-b-2 border-blue-600">
                        <td colspan="5"></td>
                        <td class="text-center"><input type="checkbox" id="hiddenCheckboxButton"></td>
                        <td class="text-center"><input type="checkbox" id="publicCheckboxButton"></td>
                    </tr>

                    @php
                        $index = 0;
                    @endphp

                    @foreach ($category->subcategories as $item)
                        <tr class="border-b">
                            <td class="pl-4">{{ $item->name }}</td>

                            <td class="text-center">
                                <div class="char minus"></div>
                            </td>

                            <td class="text-center">
                                <div class="lh-order">
                                    <input type="number" value="{{ $item->order }}" class="order"
                                        name="order[]">
                                </div>
                            </td>

                            <td class="text-center">
                                <div class="char plus"></div>
                            </td>

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
                                    class="publicCheckbox" @if (!$item->public) checked @endif>
                            </td>
                        </tr>
                        <input type="hidden" name="ids[]" value="{{ $item->id }}">
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
    initOrder();
</script>
