
@if($home['cmode'] != 14)
  <div class="row">
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-danger"><i class="far fa-envelope"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Pengajuan</span>
          <span class="info-box-number">{{ $verifikasi['pengajuan_mhs']->count('id') }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-warning">
          <i class="fa-solid fa-chalkboard-user"></i>
        </span>
        <div class="info-box-content">
          <span class="info-box-text">Disetujui WD 1 dan WR 1</span>
          <span class="info-box-number">{{ $verifikasi['pengajuan_mhs']->where('status_pengajuan', 4)->count('id') +  $verifikasi['pengajuan_mhs']->where('status_pengajuan', 5)->count('id') }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-success">
          <i class="fa-solid fa-chalkboard-user"></i>
        </span>
        <div class="info-box-content">
          <span class="info-box-text">Diproses Bakhum</span>
          <span class="info-box-number">{{ $verifikasi['pengajuan_mhs']->where('status_pengajuan', 6)->count('id') }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-info"><i class="fa-solid fa-clipboard-check"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Persetujuan</span>
          <span class="info-box-number">{{ $verifikasi['pengajuan_mhs']->where('status_pengajuan', 7)->count('id') }}</span>
        </div>
      </div>
    </div>
  </div>
@else
  <div class="row">
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-danger"><i class="far fa-envelope"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Pengajuan</span>
          <span class="info-box-number">{{ $verifikasi['pengajuan_mhs']->count('id') }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-warning">
          <i class="fa-solid fa-chalkboard-user"></i>
        </span>
        <div class="info-box-content">
          <span class="info-box-text">Disetujui Pembimbing Akademik</span>
          <span class="info-box-number">{{ $verifikasi['pengajuan_mhs']->where('status_pengajuan', 1)->count('id') }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-success">
          <i class="fa-solid fa-chalkboard-user"></i>
        </span>
        <div class="info-box-content">
          <span class="info-box-text">Disetujui Koordinator Prodi</span>
          <span class="info-box-number">{{ $verifikasi['pengajuan_mhs']->where('status_pengajuan', 2)->count('id') }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-info"><i class="fa-solid fa-clipboard-check"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Disetujui Wakil Dekan 1</span>
          <span class="info-box-number">{{ $verifikasi['pengajuan_mhs']->where('status_pengajuan', 4)->count('id') }}</span>
        </div>
      </div>
    </div>
  </div>
@endif
