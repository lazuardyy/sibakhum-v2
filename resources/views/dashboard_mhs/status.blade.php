@extends('layouts.main')

@section('content')
  <div class="container grid p-2 gap-4">
    @include('partials.header')

    {{-- <div class="flex justify-center gap-2">
      <div class="button__left">
        <a href="{{ route('cuti.create') }}" class="inline-block px-3 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
          <i class="fa-solid fa-angles-left"></i>
          <span class="hidden lg:inline-block">Ajukan Cuti</span>
        </a>
      </div>
      <div class="button__right">
        <a href="{{ route('cuti.create') }}" class="inline-block px-3 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
          <span class="hidden lg:inline-block">Ajukan Pengunduran Diri</span>
          <i class="fa-solid fa-angles-right"></i>
        </a>
      </div>
    </div> --}}

    <div class="flex flex-col lg:grid lg:grid-rows-2 gap-5">
      <div class="col-1">
        <table class="w-full">
          <thead class="border-b">
            <tr class="border-indigo-200 bg-indigo-100 border-2">
              <th colspan="5">
                <span class="uppercase text-sm lg:text-base">pengajuan cuti</span>
              </th>
            </tr>
            <tr class="border-indigo-200 bg-indigo-100 border-2">
              <th scope="col" class="text-sm lg:text-base font-medium text-gray-900 px-2 py-4 text-center border-indigo-200 border-2">
                Diajukan kepada
              </th>

              @foreach($dosens as $dosen)
                  <td class="border-b border-2 text-center border-indigo-200">
                    <span class="capitalize text-sm lg:text-base" style="text-transform: capitalize">{{ $dosen->nama }}</span>
                  </td>
              @endforeach
            </tr>

            <tr class="border-indigo-200 border-2">
              <th scope="col" class="text-sm lg:text-base font-medium text-gray-900 px-2 py-4 text-center border-indigo-200 border-2">
                Status
              </th>

              @foreach($detailCuti as $detail)
                <td class="border-b border-2 text-center border-indigo-200">
                  <i class="fa-solid fa-{{ ($detail->status_persetujuan_pa === 'disetujui' && $detail->status_persetujuan_pa !== 'menunggu') ? 'check' : '' }}"></i>
                  <i class="fa-solid fa-{{ ($detail->status_persetujuan_pa === 'ditolak' && $detail->status_persetujuan_pa !== 'menunggu') ? 'xmark' : '' }}"></i>
                  <i class="fa-solid fa-{{ ($detail->status_persetujuan_pa === 'menunggu') ? 'clock-rotate-left' : '' }}"></i>
                  <span class="capitalize text-sm lg:text-base" style="text-transform: capitalize">{{ $detail->status_persetujuan_pa }}</span>
                </td>
                <td class="border-b border-2 text-center border-indigo-200">
                  <i class="fa-solid fa-{{ ($detail->status_persetujuan_koorprodi === 'disetujui' && $detail->status_persetujuan_koorprodi !== 'menunggu') ? 'check' : '' }}"></i>
                  <i class="fa-solid fa-{{ ($detail->status_persetujuan_koorprodi === 'ditolak' && $detail->status_persetujuan_koorprodi !== 'menunggu') ? 'xmark' : '' }}"></i>
                  <i class="fa-solid fa-{{ ($detail->status_persetujuan_koorprodi === 'menunggu') ? 'clock-rotate-left' : '' }}"></i>
                  <span class="capitalize text-sm lg:text-base" style="text-transform: capitalize">{{ $detail->status_persetujuan_koorprodi }}</span>
                </td>
                <td class="border-b border-2 text-center border-indigo-200">
                  <i class="fa-solid fa-{{ ($detail->status_persetujuan_wd1 === 'disetujui' && $detail->status_persetujuan_wd1 !== 'menunggu') ? 'check' : '' }}"></i>
                  <i class="fa-solid fa-{{ ($detail->status_persetujuan_wd1 === 'ditolak' && $detail->status_persetujuan_wd1 !== 'menunggu') ? 'xmark' : '' }}"></i>
                  <i class="fa-solid fa-{{ ($detail->status_persetujuan_koorprodi === 'menunggu') ? 'clock-rotate-left' : '' }}"></i>
                  <span class="capitalize text-sm lg:text-base" style="text-transform: capitalize">{{ $detail->status_persetujuan_wd1 }}</span>
                </td>
                <td class="border-b border-2 text-center border-indigo-200">
                  <i class="fa-solid fa-{{ ($detail->status_persetujuan_wr1 === 'disetujui' && $detail->status_persetujuan_wr1 !== 'menunggu') ? 'check' : '' }}"></i>
                  <i class="fa-solid fa-{{ ($detail->status_persetujuan_wr1 === 'ditolak' && $detail->status_persetujuan_wr1 !== 'menunggu') ? 'xmark' : '' }}"></i>
                  <i class="fa-solid fa-{{ ($detail->status_persetujuan_wr1 === 'menunggu') ? 'clock-rotate-left' : '' }}"></i>
                  <span class="capitalize text-sm lg:text-base" style="text-transform: capitalize">{{ $detail->status_persetujuan_wr1 }}</span>
                </td>
              @endforeach
            </tr>
          </thead>
        </table>
      </div>
    </div>

    {{-- <div class="container overflow-auto">
      <ul>
        @foreach($detailCuti as $detail)
          <li>{{ $detail->lecturers->nama }}</li>
        @endforeach

        @foreach($dosens as $dosen)
        <li>{{ $dosen->detailCutiMhs }}</li>
          @foreach($dosen->detailCutiMhs as $detail)
            <li>{{ $detail }}</li>
          @endforeach
        @endforeach
      </ul>
    </div> --}}

    <div class="button">
      <a class="px-3 py-2.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out" href="{{ url('home/mahasiswa') }}">
        kembali
      </a>
    </div>
  </div>
@endsection
