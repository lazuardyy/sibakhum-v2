@extends('layouts.main')

@section('content')
  @include('partials.welcome')

  @if(session('user_cmode') == 9)
    <div class="grid gap-4 p-4 place-content-center justify-items-center lg:pt-7 pt-14 text-center">
      <div class="grid lg:grid-cols-2 md:grid-cols-2 gap-4">
        <a href="{{ route('pengajuan-cuti.create') }}" class="flex flex-col justify-center gap-2 px-12 lg:px-14 py-16 bg-green-600 text-white font-medium text-xs lg:text-lg leading-tight uppercase rounded-lg shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
          <i class="fa-solid fa-angles-left"></i>
          <span class="text-xs lg:text-base">Ajukan Cuti</span>
        </a>
        <a href="{{ route('pengunduran-diri.create') }}" class="flex flex-col justify-center gap-2 px-12 lg:px-14 py-16 bg-blue-600 text-white font-medium text-xs lg:text-lg leading-tight uppercase rounded-lg shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
          <i class="fa-solid fa-angles-right"></i>
          <span class="text-xs lg:text-base">Ajukan Pengunduran Diri</span>
        </a>

        {{-- url harus membawa nim mahasiswa --}}
      <a href="pengajuan-cuti/status/{{ base64_encode(session('user_username')) }}" class="flex flex-col gap-2 px-12 lg:px-14 py-16 bg-yellow-500 text-white font-medium text-xs lg:text-lg leading-tight uppercase rounded-lg shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-800 active:shadow-lg transition duration-150 ease-in-out">
          <i class="fa-solid fa-handshake text-2xl"></i>
          <span class="text-xs lg:text-base">Status Pengajuan Cuti</span>
        </a>

        {{-- url harus membawa nim mahasiswa --}}
        <a href="pengunduran-diri/{{ base64_encode(session('user_username')) }}" class="flex flex-col gap-2 px-12 lg:px-14 py-16 bg-yellow-500 text-white font-medium text-xs lg:text-lg leading-tight uppercase rounded-lg shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-800 active:shadow-lg transition duration-150 ease-in-out">
          <i class="fa-solid fa-handshake text-2xl"></i>
          <span class="text-xs lg:text-base">Status Pengunduran Diri</span>
        </a>
      </div>
    </div>
  @endif

@endsection
