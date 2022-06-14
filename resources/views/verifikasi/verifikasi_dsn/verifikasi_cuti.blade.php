@extends('layouts.main')

@section('content')
  <div class="container grid">
    @include('partials.header')
    @include('flash-message')


    <div class="bg-slate-50 shadow-md p-3 rounded-md overflow-x-scroll">
      <table class="table" id="tabel-dosen">
        <thead>
          <tr class="text-center">
            <th rowspan="2">No.</th>
            <th rowspan="2">NIM</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Program Studi</th>
            <th colspan="2">Waktu</th>
            <th rowspan="2">Details</th>
          </tr>
          <tr>
            <th>Pengajuan</th>
            <th>Persetujuan</th>
          </tr>
        </thead>
        <tbody>
          @foreach($verifikasi['pengajuan_cuti'] as $index => $pengajuan)
            @if(isset($pengajuan->nim))
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pengajuan->nim }}</td>
                <td>{{ $pengajuan->nama}}</td>
                <td>{{ $verifikasi['nama_prodi'] }}</td>

                <td>{{ $pengajuan->created_at->format("M/d/Y") }}</td>
                <td>
                  <span class="{{ ($pengajuan->status_pengajuan !== 24) ? 'bg-success' : 'bg-danger'}} px-2 py-1 rounded-lg">
                    {{ ($pengajuan->status_pengajuan === 0) ? 'Menunggu Persetujuan' : $pengajuan->refStatusPengajuan->status_pengajuan_cuti }}
                  </span>
                </td>
                <td>
                  <button type="button" class="btn btn-primary  btn-sm" data-bs-toggle="modal" data-bs-target="#modal_{{ $pengajuan->id }}" id="details">
                    <i class="fa-solid fa-eye-slash" id="button_{{ $pengajuan->nim }}"></i>
                    <i class="fa-solid fa-eye" style="display:none" id="show__{{ $pengajuan->nim }}"></i>
                  </button>
                </td>
              </tr>

              <div class="modal fade" id="modal_{{ $pengajuan->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="static_{{ $pengajuan->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="static_{{ $pengajuan->id }}">{{ $modal_title }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      @include('verifikasi.row-form')

                      <form action="{{ route('data-cuti.store') }}" method="POST">
                        @csrf
                          @include('verifikasi.form')
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@section('script')
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      var status = $('.status').attr('id');

      $(`#${status}`).on('change',function(){
          if($(this).val() == 2){
            var alasan = $('.alasan').attr('id');
            // $(`#{$alasan}`).show();
            $(`#${alasan}`).show();
            // $('#alasan').show();

          }
          else{
            var alasan = $('.alasan').attr('id');
            $(`#${alasan}`).hide();
            // $('#alasan').hide();
          }
      });
    });
  </script>
@endsection
