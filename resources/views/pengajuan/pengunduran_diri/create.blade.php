@extends('layouts.main')

@section('content')
<div class="container grid p-2 pb-4">
  {{-- @include('partials.header') --}}
  @include('flash-message')

  <div class="flex justify-center">
    <div class="mb-3 xl:w-2/4 flex mt-3" >
        <input type="text" class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Masukkan NIM mahasiswa ..." aria-label="Search" aria-describedby="button-addon2" id="search-input">

        <button type="button" class="btn btn-primary" id="search-button">
          <i class="fa-solid fa-magnifying-glass text-md"></i>
        </button>
    </div>
  </div>

  <hr>

  <div class="block p-6 rounded-lg shadow-md bg-white">
    <form action="{{route('pengunduran-diri.store')}}" method="POST" class="md:grid md:grid-cols-2 gap-x-7" id="form-md">
      @csrf
    </form>
  </div>
</div>
@endsection

@section('script')
  <script src="{{ asset('js/form-md.js') }}" type="text/javascript"></script>
@endsection
