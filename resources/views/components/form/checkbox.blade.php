<?php $name = $attributes['name'] ?? ""; ?>
<?php $checked = $attributes['checked'] ?? 0; ?>

<div class="form-check mb-2">
    <input name="{{ $name }}" <?= ($checked == 1) ? "checked" : "" ?> class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" id="flexCheckChecked">
    <label class="form-check-label inline-block text-gray-800" for="flexCheckChecked">
        {{ $slot }}
    </label>
</div>
