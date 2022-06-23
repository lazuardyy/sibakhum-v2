<div class="form-group mb-6">
  <label for="NIM" class="form-label inline-block mb-2 text-gray-700">NIM</label>
  <input type="hidden" name="nim" value="{{ $pengajuan['nim'] }}">
  <input type="hidden" name="pa" value="{{ $pengajuan['pa'] }}">
  <input type="hidden" name="nama_prodi" value="{{ $pengajuan['nama_prodi'] }}">
  <input type="hidden" name="nama_fakultas" value="{{ $pengajuan['nama_fakultas'] }}">


  <input type="text"
    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
    id="NIM"
    aria-describedby="NIM"
    placeholder="{{ $pengajuan['nim'] }}"
    readonly
  >

  @error('nim')
    <small id="nim" class="block mt-1 text-xs text-red-600">
      {{ $message }}
    </small>
  @enderror
</div>

<div class="form-group mb-6">
  <label for="nama" class="form-label inline-block mb-2 text-gray-700">Nama Lengkap</label>
  <input type="hidden" name="nama" value="{{ $pengajuan['nama_lengkap']  }}">
  <input type="text"
    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
    id="nama"
    aria-describedby="nama"
    placeholder="{{ $pengajuan['nama_lengkap'] }}"
    readonly
  >

  @error('nama')
    <small id="nama" class="block mt-1 text-xs text-red-600">
      {{ $message }}
    </small>
  @enderror
</div>

<div class="form-group mb-6">
  <label for="jenis_kelamin" class="form-label inline-block mb-2 text-gray-700">Jenis Kelamin</label>
  <input type="hidden" name="jenis_kelamin" value="{{ ($pengajuan['jenis_kelamin'] == 'L') ? 0 : 1 }}">
  <input type="text"
    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
    id="jenis_kelamin"
    required
    aria-describedby="jenis_kelamin"
    placeholder="{{ ($pengajuan['jenis_kelamin'] == 'L') ? 'Laki-Laki' : 'Perempuan' }}"
    readonly
  >
</div>

<div class="form-group mb-6">
  <label for="kode_fakultas" class="form-label inline-block mb-2 text-gray-700">Fakultas</label>
  <input type="hidden" name="kode_fakultas" value="{{ $pengajuan['kode_fakultas'] }}">

  <input type="text"
    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
    id="kode_fakultas"
    required
    aria-describedby="kode_fakultas"
    placeholder="{{ $pengajuan['nama_fakultas'] }}"
    readonly
  >
</div>

<div class="form-group mb-6">
  <label for="kode_prodi" class="form-label inline-block mb-2 text-gray-700">Program Studi</label>
  <input type="hidden" name="kode_prodi" value="{{ $pengajuan['kode_prodi'] }}">

  <input type="text"
    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
    id="kode_prodi"
    required
    aria-describedby="kode_prodi"
    placeholder="{{ $pengajuan['nama_prodi']  }}"
    readonly
  >

  @error('kode_prodi')
    <small id="prodi" class="block mt-1 text-xs text-red-600">
      {{ $message }}
    </small>
  @enderror
</div>


