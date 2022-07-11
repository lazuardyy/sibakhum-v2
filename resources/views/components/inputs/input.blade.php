<input {{ $attributes->merge(['class' => 'form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none']) }}
  {{-- type="{{ $type }}" --}}
  id="{{ $typeInput }}"
  required
  aria-describedby="{{ $typeInput }}"
  placeholder="{{ $placeholder }}"
  name="{{ $typeInput }}"
  value="{{ $value }}"
>
<small id="{{ $typeInput }}" class="block mt-1 text-xs text-gray-600 text-bold">{{ $note }}</small>
@error('{{ $typeInput }}')
  <small id="{{ $typeInput }}" class="block mt-1 text-xs text-red-600">
    {{ $message }}
  </small>
@enderror
