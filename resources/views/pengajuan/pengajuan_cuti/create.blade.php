@extends('layouts.main')

@section('content')
<div class="container grid p-2 pb-4">
  @include('partials.header')

  <div class="alert alert-info text-center">
    <ul class="list-unstyled text-left">Catatan :
        <li>Data Mahasiswa diperoleh dari SIAKAD, sehingga bila terdapat perbedaan data, silahkan perbaiki biodata anda di SIAKAD.</li>
        <li>{{ $pengajuan['nim'] }}</li>
    </ul>
  </div>

  <div class="block p-6 rounded-lg shadow-md bg-white">
    @include('flash-message')

    <form action="{{route('pengajuan-cuti.store')}}" method="POST" class="md:grid md:grid-cols-2 gap-x-7">
      @csrf
      <div>
        @include('pengajuan.index')
      </div>

      <div>
        <div class="form-group mb-6">
            <label for="no_telp" class="form-label inline-block mb-2 text-gray-700">No. Telp</label>
            <input type="tel"
              class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              id="no_telp"
              required
              aria-describedby="no_telp"
              placeholder="Masukkan nomor telepon aktif kamu"
              name="no_telp"
            >
            <small id="emailHelp" class="block mt-1 text-xs text-gray-600">Masukkan nomor handphone aktif.</small>
            @error('no_telp')
            <small id="no_telp" class="block mt-1 text-xs text-red-600">
              {{ $message }}
            </small>
          @enderror
        </div>

        <div class="form-group mb-6">
          <label for="tahun_angkatan" class="form-label inline-block mb-2 text-gray-700">Tahun Angkatan</label>
          <input type="number"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="tahun_angkatan"
            required
            aria-describedby="tahun_angkatan"
            min="2015" max="2022" step="1"
            value="{{ $pengajuan['angkatan'] }}"
            name="tahun_angkatan"
          >
        </div>

        <div class="form-group mb-6">
          <label for="semester" class="form-label inline-block mb-2 text-gray-700">Semester</label>
          <select id="semester" name="semester"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
            @for($i = 3; $i <= 8; $i++)
              <option value="{{ $i }}">{{ $i }}</option>
            @endfor
          </select>
        </div>

        <div class="form-group mb-6">
          <label for="keterangan" class="form-label inline-block mb-2 text-gray-700">Keterangan</label>
          <textarea
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="keterangan"
            required
            aria-describedby="keterangan"
            placeholder="Jelaskan alasan pengajuan cuti"
            name="keterangan"
            rows="5"
            style="resize: none;"
            value="{{ old('keterangan') }}"
            ></textarea>
          @error('keterangan')
            <small id="keterangan" class="block mt-1 text-xs text-red-600">
              {{ $message }}
            </small>
          @enderror
        </div>

        <div class="flex gap-2">
          <a href="{{ url('home') }}" class="inline-block px-3 py-2.5 bg-{{ (session('success') ? 'yellow' : 'red') }}-{{ (session('success') ? '500' : '600') }} text-white font-medium text-xs lg:leading-tight uppercase rounded shadow-md hover:bg-{{ (session('success') ? 'yellow' : 'red ') }}-{{ (session('success') ? '600' : '700') }} hover:shadow-lg focus:bg-{{ (session('success') ? 'yellow' : 'red') }}-{{ (session('success') ? '600' : '700') }} focus:shadow-lg focus:outline-none focus:ring-0 active:bg-{{ (session('success') ? 'yellow' : 'red') }}-{{ (session('success') ? '700' : '800') }} active:shadow-lg transition duration-150 ease-in-out">
            <i class="{{ (session('success') ? 'fa-solid fa-arrow-left underline decoration-1' : 'fa-solid fa-ban') }}
            "></i>
            <span class="text-xs lg:text-md">{{ (session('success') ? 'Kembali' : 'Batal') }}</span>
          </a>

            <button type="submit"
              class="px-3 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
              >
                <i class="fa-solid fa-floppy-disk"></i>
                <span class="text-xs lg:text-md">Ajukan</span>
            </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
