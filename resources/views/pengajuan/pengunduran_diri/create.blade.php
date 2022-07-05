@extends('layouts.main')

@section('content')
<div class="container grid p-2 pb-4">
  @include('partials.header')
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

  <div class="p-6 rounded-lg shadow-md bg-white hidden" id="form-md">
    <form class="md:grid md:grid-cols-2 gap-x-7">
      {{-- <div class="md:grid md:grid-cols-2 gap-x-7" id="form-md"></div> --}}
      @csrf
      <div>
        <div class="form-group mb-6">
          <label for="nim" class="form-label inline-block mb-2 text-gray-700">NIM</label>
          {{-- <input type="hidden" name="nim" value=""> --}}
          <input type="hidden" name="pa" value="">
          <input type="hidden" name="nama_prodi" value="">
          <input type="hidden" name="nama_fakultas" value="">
          <input type="hidden" name="jenis_pengajuan" value="2">
          <input type="hidden" name="status_pengajuan" value="4">

          <input type="text"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            required
            id="nim"
            aria-describedby="nim"
            placeholder=""
            value=""
          >
        </div>

        <div class="form-group mb-6">
          <label for="nama" class="form-label inline-block mb-2 text-gray-700">Nama Lengkap</label>
          {{-- <input type="hidden" name="nama" value=""> --}}
          <input type="text"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            required
            id="nama"
            aria-describedby="nama"
            placeholder=""
            value=""
          >
        </div>

        <div class="form-group mb-6">
          <label for="jenis_kelamin" class="form-label inline-block mb-2 text-gray-700">Jenis Kelamin</label>
          <input type="hidden" name="jenis_kelamin" value="">
          <input type="text"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="jenis_kelamin"
            required
            aria-describedby="jenis_kelamin"
            placeholder=""
            readonly
          >
        </div>

        <div class="form-group mb-6">
          <label for="nama_fakultas" class="form-label inline-block mb-2 text-gray-700">Fakultas</label>
          <input type="hidden" name="kode_fakultas" value="">

          <input type="text"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="nama_fakultas"
            required
            aria-describedby="nama_fakultas"
            placeholder=""
            readonly
          >
        </div>

        <div class="form-group mb-6">
          <label for="nama_prodi" class="form-label inline-block mb-2 text-gray-700">Program Studi</label>
          <input type="hidden" name="kode_prodi" value="">

          <input type="text"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="nama_prodi"
            required
            aria-describedby="nama_prodi"
            placeholder=""
            readonly
          >
        </div>

        <div class="form-group mb-6">
          <label for="jenjang" class="form-label inline-block mb-2 text-gray-700">Jenjang</label>
          <input type="hidden" name="jenjang" value="">

          <input type="text"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="jenjang"
            required
            aria-describedby="jenjang"
            placeholder=""
            readonly
          >

          @error('jenjang')
            <small id="jenjang" class="block mt-1 text-xs text-red-600">
              {{ $message }}
            </small>
          @enderror
        </div>
      </div>

      <div>
        <div class="form-group mb-6">
          <label for="email" class="form-label inline-block mb-2 text-gray-700">Email</label>
          <input type="email"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="email"
            required
            aria-describedby="email"
            placeholder="Masukkan google mail (gmail) kamu"
            name="email"
          >
          <small id="emailHelp" class="block mt-1 text-xs text-gray-600">Masukkan gmail aktif.</small>
          @error('email')
            <small id="email" class="block mt-1 text-xs text-red-600">
              {{ $message }}
            </small>
          @enderror
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
          >
          <small id="no_telp_help" class="block mt-1 text-xs text-gray-600">Masukkan nomor handphone aktif.</small>
        </div>

        <div class="form-group mb-6">
          <label for="tahun_angkatan" class="form-label inline-block mb-2 text-gray-700">Tahun Angkatan</label>
          <input type="number"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="tahun_angkatan"
            required
            aria-describedby="tahun_angkatan"
            min="2015" max="2022" step="1"
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
            placeholder="Jelaskan alasan pengunduran diri"
            name="keterangan"
            rows="5"
            style="resize: none;"
            ></textarea>
        </div>

        <div class="flex gap-2">
          <a href="/home" class="px-3 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
            <i class="fa-solid fa-ban"></i>
            <span class="text-xs lg:text-md">Batal</span>
          </a>

            <button type="button" class="px-3 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" id="save-data"
              >
                <i class="fa-solid fa-floppy-disk"></i>
                <span class="text-xs lg:text-md">Ajukan</span>
            </button>
        </div>
      </div>
    </form>
  </div>

  <div id="not-found" class="hidden">
    <div class="flex flex-col items-center justify-center p-4">
      <div class="text-center">
        <h1 class="text-gray-700 text-4xl font-bold">
          <i class="fa-solid fa-exclamation-triangle text-red-600"></i>
        </h1>
        <p class="text-gray-700 text-lg">
          Maaf, data tidak ditemukan.
        </p>
      </div>

      <div class="buat-baru">
        <button id="buat-baru" class="px-3 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
          <i class="fa-solid fa-plus"></i>
          <span class="text-xs lg:text-md">Buat Baru</span>
        </button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
  <script src="{{ asset('js/form-md.js') }}" type="text/javascript"></script>
@endsection
