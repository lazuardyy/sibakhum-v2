{{-- <a {{ $attributes->merge(['class' => 'px-2.5 py-2 bg-'.$btnColor.'-600 text-white font-medium leading-tight uppercase rounded shadow-md hover:bg-'.$btnColor.'-700 hover:shadow-lg focus:bg-$btnColor-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-'.$btnColor.'-800 active:shadow-lg transition duration-150 ease-in-out']) }}>
  <i class="{{ $buttonIcon }} mr-0.5"></i>
  <span class="text-xs">{{ $buttonName }}</span>
</a> --}}

<a {{ $attributes->merge(['class' => 'btn bg-'.$btnColor.'-600 hover:bg-'.$btnColor.'-700 hover:shadow-lg focus:bg-'.$btnColor.'-700  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-'.$btnColor.'-800 active:shadow-lg transition duration-150 ease-in-out rounded text-sm']) }}>
  <i class="{{ $buttonIcon }}"></i>
  <span class="uppercase ml-0.5">{{ $buttonName }}</span>
</a>
