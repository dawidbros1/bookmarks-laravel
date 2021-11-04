<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Zarządzaj kategoriami') }}
        </h2>
    </x-slot>

    <x-manage.main>
        <x-form-section action="{{ route('update.categories') }}">
            <table class="w-full">
                <thead>
                    <th class="text-left w-8/12 md:w-9/12 xl:w-10/12">Nazwa kategorii</th>
                    <th></th>
                    <th>
                        <img class="block m-auto" src="{{ URL::asset('/images/order.png') }}" alt="profile Pic"
                            height="25" width="25" title="Kolejność wyświetlania" )>
                    </th>

                    <th colspan="3"></th>
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
                        <td colspan="6"></td>
                        <td class="text-center"><input type="checkbox" id="hiddenCheckboxButton"></td>
                        <td class="text-center"><input type="checkbox" id="publicCheckboxButton"></td>
                    </tr>

                    @foreach ($categories as $key => $category)
                        <tr class="border-b">
                            <td>
                                {{ $category->name }}
                            </td>

                            <td class="text-center">
                                <div class="char minus"></div>
                            </td>

                            <td class="text-center">
                                <div class="lh-order">
                                    <input type="number" value="{{ $category->order }}" class="order"
                                        name="order[]">
                                </div>
                            </td>

                            <td class="text-center">
                                <div class="char plus"></div>
                            </td>

                            <x-manage.table-column-image-link
                                link="{{ route('manage.category.subcategories', ['id' => $category->id]) }}"
                                image_name="folder.png">
                            </x-manage.table-column-image-link>

                            <x-manage.table-column-image-link
                                link="{{ route('manage.category.pages', ['id' => $category->id]) }}"
                                image_name="page.png">
                            </x-manage.table-column-image-link>

                            <td class="text-center">
                                <input name="hidden[{{ $key }}]" type="hidden" value="0">
                                <input name="hidden[{{ $key }}]" type="checkbox" value="1"
                                    class="hiddenCheckbox" @if ($category->hidden) checked @endif>
                            </td>
                            <td class="text-center">
                                <input name="public[{{ $key }}]" type="hidden" value="0">
                                <input name="public[{{ $key }}]" type="checkbox" value="1"
                                    class="publicCheckbox" @if (!$category->public) checked @endif>
                            </td>
                        </tr>
                        <input type="hidden" name="ids[]" value="{{ $category->id }}">
                    @endforeach
                </tbody>
            </table>

            @if (count($categories) > 0)
                <x-jet-button type="submit" class="mt-2">Zapisz</x-jet-button>
            @else
                <x-jet-button type="submit" class="mt-2" disabled>Zapisz</x-jet-button>
            @endif

        </x-form-section>
    </x-manage.main>
</x-main-layout>

<script>
    initCheckboxButton('public');
    initCheckboxButton('hidden');
    initOrder();
</script>
