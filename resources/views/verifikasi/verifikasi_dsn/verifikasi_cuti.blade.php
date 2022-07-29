@extends('layouts.main')

@section('content')
  <div class="container">
    @include('partials.header')
    @include('flash-message')


    <div class="bg-slate-50 shadow-md p-3 rounded-md overflow-x-scroll">
      <table class="table hover compact" id="tabel-dosen">
        <thead>
          <tr>
            <th>No.</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Program Studi</th>
            <th>Waktu Pengajuan</th>
            <th>Status Persetujuan</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pengajuan_mhs as $index => $pengajuan)
            @if(isset($pengajuan->nim))
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pengajuan->nim }}</td>
                <td>{{ $pengajuan->nama}}</td>
                <td>{{ $pengajuan->nama_prodi }}</td>

                <td>{{ $pengajuan->created_at->format('d M Y') }} <br> Pukul {{ $pengajuan->created_at->format('H:i') }} WIB</td>
                <td class="flex">
                  @if($pengajuan->status_pengajuan !== 0)
                    <span class="w-full {{ ($pengajuan->status_pengajuan <= 7) ? 'bg-success' : 'bg-danger' }} px-2 py-1 rounded-lg">
                      {{  $pengajuan->refStatusPengajuan->status_pengajuan_cuti }}
                    </span>
                  @else
                    <span class="w-full bg-warning px-2 py-1 rounded-lg">
                      Menunggu Persetujuan
                    </span>
                  @endif
                </td>
                <td class="text-center">
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

                      <form action="{{ route('data-mhs.verifikasi-dosen') }}" method="POST">
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
      var id = $('[id="status_persetujuan"]');
      console.log(id[0]);

      $.each([ id ], function( index, value ) {
        console.log(index, value);
      });
    });
  </script>
@endsection
