<div class="{{ $class }}">

    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="{{ $name }}">
        {{ $label }}
    </label>

    <input
        autocomplete="off"
        name="{{ $name }}"
        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        id="{{ $name }}"
        type="{{ $type }}"
        value="{{ isset($value) ? old($name, $value) : '' }}"
        placeholder="{{ $placeholder }}">
    @error($name)
    <p class="text-red-600 text-xs font-bold">{{ __($message) }}</p>
    @else
        @isset($help)
            <p class="text-gray-600 text-xs italic">{{ $help }}</p>
        @endisset
        @enderror
</div>
