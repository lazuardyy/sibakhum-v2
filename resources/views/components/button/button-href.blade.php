<a {{ $attributes->merge(['class' => 'px-3 py-2.5 bg-'.$btnColor.'-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-'.$btnColor.'-700 hover:shadow-lg focus:bg-$btnColor-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-'.$btnColor.'-800 active:shadow-lg transition duration-150 ease-in-out']) }}>
  <i class="{{ $buttonIcon }} mr-0.5"></i>
  <span>{{ $buttonName }}</span>
</a>
