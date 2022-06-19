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
    <p>: {{ $verifikasi['nama_fakultas'] ?? $pengajuan->nama_fakultas }}</p>
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


