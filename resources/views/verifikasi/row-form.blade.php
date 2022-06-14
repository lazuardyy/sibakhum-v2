<div class="row" style="margin-bottom: 0">
  <div class="col-4">
    <p>NIM</p>
    <p>Nama</p>
    <p>Jenis Kelamin</p>
    <p>Fakultas</p>
    <p>Program Studi</p>
    <p>No HP</p>
    <p>Tahun Angkatan</p>
    <p>Semester</p>
    <p>Jenis Pengajuan</p>
    <p>Keterangan Pengajuan</p>
    <p>Waktu Pengajuan</p>
    @if($home['cmode'] == '2' || $home['cmode'] == '8' && $pengajuan->status_pengajuan !== 0)
      <p>Status Persetujuan</p>
    @endif
  </div>
  <div class="col-8">
    <p>: {{ $pengajuan->nim }}</p>
    <p>: {{ $pengajuan->nama }}</p>
    <p>: {{ ($pengajuan->jenis_kelamin === 0) ? 'Laki-Laki' : 'Perempuan' }}</p>
    <p>: {{ $verifikasi['nama_fakultas'] }}</p>
    <p>: {{ $verifikasi['nama_prodi'] }}</p>
    <p>: {{ $pengajuan->no_telp }}</p>
    <p>: {{ $pengajuan->tahun_angkatan }}</p>
    <p>: {{ $pengajuan->semester }}</p>
    <p>: {{ ($pengajuan->jenis_pengajuan == 1) ? 'Cuti' : '' }}</p>
    <p>: {{ $pengajuan->keterangan }}</p>
    <p>: {{ $pengajuan->created_at->format("M/d/Y")  }}</p>

    @if($home['cmode'] == '2' || $home['cmode'] == '8' && $pengajuan->status_pengajuan !== 0)
      @if($pengajuan->jenis_pengajuan === 1)
        <div class="">
          <p class="bg-success rounded-sm pl-2">
            {{ $pengajuan->refStatusPengajuan->status_pengajuan_cuti  }}
            <i class="nav-icon fa-solid fa-check"></i>
          </p>
        </div>
      @else
        <div class="">
          <p class="bg-success rounded-sm pl-2">
            {{ $pengajuan->refStatusPengajuan->status_pengunduran_diri }}
            <i class="nav-icon fa-solid fa-check"></i>
          </p>
        </div>
      @endif
    @endif
  </div>
</div>
