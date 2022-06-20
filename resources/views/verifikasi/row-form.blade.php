<div class="row border-bottom">
  <div class="col-4">
    <p>NIM</p>
  </div>
  <div class="col-8">
    <p>: {{ $pengajuan->nim }}</p>
  </div>
</div>
<div class="row border-bottom">
  <div class="col-4">
    <p>Nama</p>
  </div>
  <div class="col-8">
    <p>: {{ $pengajuan->nama }}</p>
  </div>
</div>
<div class="row border-bottom">
  <div class="col-4">
    <p>Jenis Kelamin</p>
  </div>
  <div class="col-8">
    <p>: {{ ($pengajuan->jenis_kelamin === 0) ? 'Laki-Laki' : 'Perempuan' }}</p>
  </div>
</div>
<div class="row border-bottom">
  <div class="col-4">
    <p>Fakultas</p>
  </div>
  <div class="col-8">
    {{-- @if($verifikasi['nama_fakultas'] !== '') --}}
      <p>: {{ $verifikasi['nama_fakultas'] ?? $pengajuan->nama_fakultas ?? $pengajuan['nama_fakultas'] }}</p>
    {{-- @elseif($pengajuan->nama_fakultas !== null) --}}
    {{-- @else --}}

    {{-- @endif --}}
  </div>
</div>
<div class="row border-bottom">
  <div class="col-4">
    <p>Prodi</p>
  </div>
  <div class="col-8">
    {{-- {{ dd($pengajuan->studyProgram->nama_prodi) }} --}}
    <p>: {{ ($verifikasi['nama_prodi'] === '') ? $pengajuan->studyProgram->nama_prodi : $verifikasi['nama_prodi'] }}</p>
  </div>
</div>

@if($home['cmode'] !== config('constants.users.mahasiswa'))
  <div class="row border-bottom">
    <div class="col-4">
      <p>No. Telp</p>
    </div>
    <div class="col-8">
      <p>: {{ $pengajuan->no_telp }}</p>
    </div>
  </div>
  <div class="row border-bottom">
    <div class="col-4">
      <p>Tahun Angkatan</p>
    </div>
    <div class="col-8">
      <p>: {{ $pengajuan->tahun_angkatan }}</p>
    </div>
  </div>
  <div class="row border-bottom">
    <div class="col-4">
      <p>Semester</p>
    </div>
    <div class="col-8">
      <p>: {{ $pengajuan->semester }}</p>
    </div>
  </div>
  <div class="row border-bottom">
    <div class="col-4">
      <p>Jenis Pengajuan</p>
    </div>
    <div class="col-8">
      <p>: {{ ($pengajuan->jenis_pengajuan == 1) ? 'Cuti' : 'Pengunduran Diri' }}</p>
    </div>
  </div>
  <div class="row border-bottom">
    <div class="col-4">
      <p>Keterangan</p>
    </div>
    <div class="col-8">
      <p class="text-justify">: {{ $pengajuan->keterangan }}</p>
    </div>
  </div>
  <div class="row border-bottom">
    <div class="col-4">
      <p>Tanggal Pengajuan</p>
    </div>
    <div class="col-8">
      <p>: {{ $pengajuan->created_at->format("M/d/Y")  }}</p>
    </div>
  </div>
  <div class="row border-bottom">
    <div class="col-4">
      <p>Status Persetujuan</p>
    </div>
    <div class="col-8">
      <p>: {{ $pengajuan->refStatusPengajuan->status_pengajuan_cuti  }}</p>
    </div>
  </div>
@else
<div class="border-2 rounded border-amber-400 mt-2 px-2">
  <div class="alert alert-warning text-center mt-2">
    <ul class="list-unstyled text-left" style="margin-bottom: 0">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <span>Perhatian:</span>
          <li class="text-justify">Anda dapat melakukan perbaikan data hanya <strong>1 kali.</strong> Oleh karena itu, pastikan kembali pengisian data telah benar sebelum melakukan pengiriman data.</li>
    </ul>
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
        value="{{ $pengajuan->no_telp }}"
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
      value="{{ $pengajuan->tahun_angkatan }}"
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
      >{{ $pengajuan->keterangan }}</textarea>
    @error('keterangan')
      <small id="keterangan" class="block mt-1 text-xs text-red-600">
        {{ $message }}
      </small>
    @enderror
  </div>
</div>
@endif


