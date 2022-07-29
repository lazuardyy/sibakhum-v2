<button {{ $attributes->merge(['class' => 'btn bg-'.$buttonColor.'-600 hover:bg-'.$buttonColor.'-700 hover:shadow-lg focus:bg-'.$buttonColor.'-700  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-'.$buttonColor.'-800 active:shadow-lg transition duration-150 ease-in-out rounded text-white text-sm']) }}
  >
    <i class="{{ $buttonIcon }}"></i>
    <span class="ml-0.5 uppercase">{{ $buttonName }}</span>
</button>
