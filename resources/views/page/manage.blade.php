<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Zarządzaj stronami' }}
        </h2>
    </x-slot>

    @if (count($parent->pages) > 0)
        <x-form.section action="{{ route('page.manage', ['type' => $type]) }}">
            <table class="w-full">

                <thead>
                    <tr>
                        <th class="text-left w-8/12 md:w-9/12 xl:w-10/12">{{ $parent->name }}</th>
                        <x-manage.table-th colspan="3" image="position"></x-manage.table-th>
                        <x-manage.table-th image="hidden"></x-manage.table-th>
                        <x-manage.table-th image="lock"></x-manage.table-th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="border-b-2 border-blue-600">
                        <td colspan="4"></td>
                        <td class="text-center"><input type="checkbox" id="hiddenCheckboxButton"></td>
                        <td class="text-center"><input type="checkbox" id="privateCheckboxButton"></td>
                    </tr>

                    @foreach ($parent->pages as $index => $item)
                        <tr class="border-b">
                            <td class="pl-4">{{ $item->name }}</td>

                            <x-manage.sorting position="{{ $item->position }}"></x-manage.sorting>

                            <x-manage.checkbox name="hidden" index="{{ $index }}"
                                checked="{{ $item->hidden }}">
                            </x-manage.checkbox>

                            <x-manage.checkbox name="private" index="{{ $index }}"
                                checked="{{ $item->private }}">
                            </x-manage.checkbox>
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
    initCheckboxButton('private');
    initCheckboxButton('hidden');
    initSort();
</script>
