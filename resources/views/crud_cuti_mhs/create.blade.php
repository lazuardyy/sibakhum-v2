@extends('layouts.main')

@section('content')
<div class="container grid gap-4 justify-items-center p-2 pb-4">
  @include('partials.header')

  <div class="block p-6 rounded-lg shadow-lg bg-white w-full lg:w-7/12">
    @include('flash-message')

    <form class="" action="{{route('cuti.store')}}" method="POST">
      @csrf
      <div class="form-group mb-6">
        <label for="NIM" class="form-label inline-block mb-2 text-gray-700">NIM</label>
        <input type="text"
          class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
          id="NIM"
          required
          aria-describedby="NIM"
          placeholder="NIM kamu"
          name="nim"
          value="{{ old('nim') }}"
          autofocus
        >

        @error('nim')
          <small id="nim" class="block mt-1 text-xs text-red-600">
            {{ $message }}
          </small>
        @enderror
      </div>

      <div class="form-group mb-6">
          <label for="nama" class="form-label inline-block mb-2 text-gray-700">Nama Lengkap</label>
          <input type="text"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="nama"
            required
            aria-describedby="nama"
            placeholder="Nama kamu"
            name="nama"
            value="{{ old('nama') }}"
          >

          @error('nama')
          <small id="nama" class="block mt-1 text-xs text-red-600">
            {{ $message }}
          </small>
        @enderror
      </div>

      <div class="form-group mb-6">
        <label for="jenis_kelamin" class="form-label inline-block mb-2 text-gray-700">Jenis Kelamin</label>
        <select id="jenis_kelamin" name="jenis_kelamin"
          class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
          <option value="1">Laki-Laki</option>
          <option value="0">Perempuan</option>
        </select>
      </div>

      <div class="form-group mb-6">
        <label for="prodi" class="form-label inline-block mb-2 text-gray-700">Program Studi</label>
        <input type="text"
          class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
          id="prodi"
          required
          aria-describedby="prodi"
          placeholder="Prodi kamu"
          name="prodi"
          value="{{ old('prodi') }}"
        >

        @error('prodi')
          <small id="prodi" class="block mt-1 text-xs text-red-600">
            {{ $message }}
          </small>
        @enderror
      </div>

      <div class="form-group mb-6">
          <label for="faculty_id" class="form-label inline-block mb-2 text-gray-700">Fakultas</label>
          <select id="faculty_id" name="faculty_id" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
          >
            <option value = 1>
              Fakultas Ilmu Pendidikan
            </option>
            <option value = 2>
              Fakultas Bahasa dan Seni
            </option>
            <option class="truncate" value = 3>
              Fakultas Matematika dan Ilmu ...
            </option>
            <option value = 4>
              Fakultas Ilmu Sosial
            </option>
            <option value = 5>
              Fakultas Teknik
            </option>
            <option value = 6>
              Fakultas Ilmu Olahraga
            </option>
            <option value = 7>
              Fakultas Ekonomi
            </option>
            <option value = 8>
              Fakultas Pendidikan Psikologi
            </option>
          </select>
      </div>

      <div class="form-group mb-6">
          <label for="no_telp" class="form-label inline-block mb-2 text-gray-700">No. Telp</label>
          <input type="tel"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="no_telp"
            required
            aria-describedby="no_telp"
            placeholder="Masukkan nomor telepon aktif kamu"
            name="no_telp"
            value="{{ old('no_telp') }}"
          >

          @error('no_telp')
          <small id="no_telp" class="block mt-1 text-xs text-red-600">
            {{ $message }}
          </small>
        @enderror
      </div>

      {{-- <div class="form-group mb-6">
          <label for="email" class="form-label inline-block mb-2 text-gray-700">Email</label>
          <input type="email"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="email"
            required
            aria-describedby="email"
            placeholder="Masukkan email kamu"
            name="email"
            value="{{ old('email') }}"
          >

          @error('email')
          <small id="email" class="block mt-1 text-xs text-red-600">
            {{ $message }}
          </small>
        @enderror
      </div> --}}

      <div class="form-group mb-6">
          <label for="tahun_angkatan" class="form-label inline-block mb-2 text-gray-700">Tahun Angkatan</label>
          <input type="number"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="tahun_angkatan"
            required
            aria-describedby="tahun_angkatan"
            min="2015" max="2022" step="1" value="2016"
            {{-- placeholder="Enter tahun_angkatan" --}}
            name="tahun_angkatan"
          >
      </div>

      <div class="form-group mb-6">
          <label for="keterangan" class="form-label inline-block mb-2 text-gray-700">Keterangan</label>
          <textarea
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="keterangan"
            required
            aria-describedby="keterangan"
            placeholder="Jelaskan keterangan pengajuan cuti"
            name="keterangan"
            rows="5"
            style="resize: none;"
            {{-- value="{{ old('keterangan') }}" --}}
            ></textarea>
          @error('keterangan')
            <small id="keterangan" class="block mt-1 text-xs text-red-600">
              {{ $message }}
            </small>
          @enderror
      </div>

      <div class="flex justify-end gap-2">
        <a href="{{ url('home/mahasiswa') }}" class="inline-block px-3 py-2.5 bg-{{ (session('success') ? 'yellow' : 'red') }}-{{ (session('success') ? '500' : '600') }} text-white font-medium text-xs lg:leading-tight uppercase rounded shadow-md hover:bg-{{ (session('success') ? 'yellow' : 'red ') }}-{{ (session('success') ? '600' : '700') }} hover:shadow-lg focus:bg-{{ (session('success') ? 'yellow' : 'red') }}-{{ (session('success') ? '600' : '700') }} focus:shadow-lg focus:outline-none focus:ring-0 active:bg-{{ (session('success') ? 'yellow' : 'red') }}-{{ (session('success') ? '700' : '800') }} active:shadow-lg transition duration-150 ease-in-out">
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
    </form>
  </div>
</div>
@endsection
