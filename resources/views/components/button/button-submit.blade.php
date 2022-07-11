<button {{ $attributes->merge(['class' => 'px-3 py-2.5 bg-'.$buttonColor.'-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-'.$buttonColor.'-700 hover:shadow-lg focus:bg-'.$buttonColor.'-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-'.$buttonColor.'-800 active:shadow-lg transition duration-150 ease-in-out cursor-pointer']) }}
  >
    <i class="{{ $buttonIcon }} mr-0.5"></i>
    <span>{{ $buttonName }}</span>
</button>
