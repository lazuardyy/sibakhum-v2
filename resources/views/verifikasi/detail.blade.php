@extends('layouts.main')

@section('content')
<div class="container">
  @include('partials.header')
  @include('flash-message')

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ $pengajuan->nama }}</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-{{ ($home['cmode'] == '3') ? '6' : '12' }}">
          <div class="alert alert-primary text-center">
            <ul class="list-unstyled text-left" style="margin-bottom: 0">
                <li>Data Mahasiswa berasal dari form pengajuan.</li>
            </ul>
          </div>
          <div class="col">
            @include('verifikasi.row-form')
          </div>
        </div>

        @if($home['cmode'] == '3')
          <div class="col-sm-6">
            <div class="alert alert-success text-center">
              <ul class="list-unstyled text-left" style="margin-bottom: 0">
                  <li>Data Mahasiswa berasal dari SIAKAD.</li>
              </ul>
            </div>
            <div class="col">
              @foreach($data_mhs as $pengajuan)
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
                {{-- <div class="row border-bottom">
                  <div class="col-4">
                    <p>Jenis Kelamin</p>
                  </div>
                  <div class="col-8">
                    <p>: {{ ($pengajuan->kelamin === 'L') ? 'Laki-Laki' : 'Perempuan' }}</p>
                  </div>
                </div> --}}
                {{-- <div class="row border-bottom">
                  <div class="col-4">
                    <p>Fakultas</p>
                  </div>
                  <div class="col-8">
                    <p>: {{ $pengajuan->namaFakultas }}</p>
                  </div>
                </div> --}}
                <div class="row border-bottom">
                  <div class="col-4">
                    <p>Prodi</p>
                  </div>
                  <div class="col-8">
                    <p>: {{ $pengajuan->namaProdi }}</p>
                  </div>
                </div>
                <div class="row border-bottom">
                  <div class="col-4">
                    <p>Jenjang</p>
                  </div>
                  <div class="col-8">
                    <p>: {{ $pengajuan->jenjangProdi }}</p>
                  </div>
                </div>
                <div class="row border-bottom">
                  <div class="col-4">
                    <p>No. Telp</p>
                  </div>
                  <div class="col-8">
                    <p>: {{ $pengajuan->hpm }}</p>
                  </div>
                </div>
                <div class="row border-bottom">
                  <div class="col-4">
                    <p>Tahun Angkatan</p>
                  </div>
                  <div class="col-8">
                    <p>: {{ $pengajuan->angkatan ?? '-' }}</p>
                  </div>
                </div>
                <div class="row border-bottom">
                  <div class="col-4">
                    <p>Semester</p>
                  </div>
                  <div class="col-8">
                    <p>: {{ $pengajuan->semester ?? '-' }}</p>
                  </div>
                </div>
                {{-- <div class="row border-bottom">
                  <div class="col-4">
                    <p>Jenis Pengajuan</p>
                  </div>
                  <div class="col-8">
                    <p>: {{ $pengajuan->jenis_pengajuan ?? '-' }}</p>
                  </div>
                </div> --}}
                <div class="row border-bottom">
                  <div class="col-4">
                    <p>Keterangan</p>
                  </div>
                  <div class="col-8">
                    <p class="text-justify">: -</p>
                  </div>
                </div>
                <div class="row border-bottom">
                  <div class="col-4">
                    <p>Tanggal Pengajuan</p>
                  </div>
                  <div class="col-8">
                    <p>: -</p>
                  </div>
                </div>
                {{-- <div class="row border-bottom">
                  <div class="col-4">
                    <p>Status Persetujuan</p>
                  </div>
                  <div class="col-8">
                    <p>: -</p>
                  </div>
                </div> --}}
              @endforeach
            </div>
          </div>
        @endif
      </div>

      <div class="row">

      </div>
    </div>
    <div class="card-footer mb-2">
      <x-button.button-href buttonName="kembali" btnColor="blue" href="{{ route('data-mhs.index') }}" buttonIcon="fa-solid fa-angle-left" class="text-sm"/>
    </div>
  </div>
</div>
@endsection
