{{-- @if ($message = Session::get('success')) --}}
  {{-- <div
    class="bg-green-100 w-full lg:w-7/12 p-4 text-base text-green-700 rounded shadow-md flex gap-2 content-center items-center"
  >
    <i class="fa-solid fa-circle-check"></i>
    <p class="flex-1">{{ $message }}</p>
    <div class="button">
      <a href="{{ route('user.index') }}" class="underline decoration-1 text-sm text-blue-600 hover:text-blue-700 transition duration-300 ease-in-out mb-4 cursor-pointer">
          <i class="fa-solid fa-arrow-left underline decoration-1"></i>
          <span class="underline decoration-1">Kembali</span>
      </a>
    </div>
  </div> --}}

{{-- @endif --}}

{{-- @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @include('sweetalert::alert')
@endif --}}

{{-- @if (session('error'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @include('sweetalert::alert')
@endif --}}

@if(session()->has('success'))
  @include('sweetalert::alert')
@endif






