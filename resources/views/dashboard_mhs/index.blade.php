@extends('layouts.main')

@section('content')
  @include('partials.welcome')

  <div class="grid grid-rows-2 gap-4 p-4 place-content-center justify-items-center lg:pt-7 pt-14 text-center">
    <div class="rows flex flex-col md:flex-row lg:flex-row gap-4">
      <a href="{{ route('cuti.create') }}" class="flex flex-col flex-1 justify-center gap-2 px-12 lg:px-20 py-16 lg:py-10 bg-green-600 text-white font-medium text-xs lg:text-lg leading-tight uppercase rounded-lg shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
        <i class="fa-solid fa-angles-left"></i>
        <span class="text-xs lg:text-base">Ajukan Cuti</span>
      </a>
      <a href="{{ route('cuti.create') }}" class="flex flex-col flex-1 justify-center gap-2 px-12 lg:px-20 py-16 lg:py-10 bg-blue-600 text-white font-medium text-xs lg:text-lg leading-tight uppercase rounded-lg shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
        <i class="fa-solid fa-angles-right"></i>
        <span class="text-xs lg:text-base">Ajukan Pengunduran Diri</span>
      </a>
    </div>
    <div class="rows w-full">
      <a href="{{ url('mahasiswa/status-pengajuan') }}" class="flex flex-col gap-2 px-12 lg:px-20 py-16 bg-yellow-500 text-white font-medium text-xs lg:text-lg leading-tight uppercase rounded-lg shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-800 active:shadow-lg transition duration-150 ease-in-out">
        <i class="fa-solid fa-handshake text-2xl"></i>
        <span class="text-xs lg:text-base">Status Pengajuan</span>
      </a>
    </div>
  </div>

@endsection
