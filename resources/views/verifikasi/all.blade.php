@extends('layouts.main')

@section('content')
  <div class="container">
    @include('partials.header')
    @include('flash-message')

    <form action="{{ route('data-pengajuan.store') }}" method="post">
      @csrf
      <div class="card">
        <div class="card-header">
          <button type="button" data-bs-toggle="modal" data-bs-target="#submitModal" class="btn btn-outline-success">
            <i class="fa-solid fa-paper-plane mr-1"></i>
            Proses
          </button>

          <div class="modal fade" id="submitModal" tabindex="-1" aria-labelledby="submitModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header" style="justify-content: start; align-items:center; gap:.5rem;">
                  <div class="bg-warning d-flex align-items-center gap-1 pl-2 pr-2 rounded-md">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <h5 class="modal-title" id="submitModal">Submit Persetujuan</h5>
                  </div>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <h6>Apakah anda yakin dengan status persetujuan yang dipilih?</h6>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger text-white font-medium leading-tight rounded-sm shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0" data-bs-dismiss="modal">Batal</button>

                  <button type="submit" class="btn btn-primary text-white font-medium leading-tight rounded-sm shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0" data-toggle="tooltip" data-placement="top" title="Verifikasi Data" >Proses</button>
                </div>
              </div>
            </div>
          </div>
          {{-- <button type="button" class="btn btn-outline-primary" id="btnTambahPeriode" data-bs-toggle="modal" data-bs-target="#modal-periode"><i class="ace-icon fa fa-plus"></i> Periode Baru</button> --}}
          {{-- <div class="card-title pr-2 border-r-2 border-black">
            <button type="button" id="menu-bar" class="btn btn-info btn-sm">
              <i class="fa-solid fa-gear text-xs"></i>
                Menu Bar
            </button>
          </div>
          @if($verifikasi['all_pengajuan'] !== [])
            <div class="card-tools">
              <div id="pilih-semua">
                <label for="setujui-semua" class="btn btn-sm btn-primary mr-1 disetujui" style="margin-bottom: 0" id="1">
                  <i class="fa-solid fa-square-check mr-1"></i>
                  Pilih Setujui Semua
                </label>
                <input type="checkbox" id="setujui-semua" class="d-none">

                <label for="tolak-semua" class="btn btn-sm btn-danger mr-1 ditolak" style="margin-bottom: 0" id="2">
                  <i class="fa-solid fa-square-xmark mr-1"></i>
                  Pilih Tolak Semua
                </label>
                <input type="checkbox" id="tolak-semua" class="d-none">

                <button type="button" data-bs-toggle="modal" data-bs-target="#submitModal" class="btn btn-sm btn-success mr-1">
                  <i class="fa-solid fa-paper-plane mr-1"></i>
                  Proses
                </button>
              </div>
            </div>
          @endif --}}
        </div>

        <div class="card-body p-3 overflow-x-scroll">
          <table class="table compact" id="table-all-data">
            <thead>
              <tr>
                <th id="pilih">
                  <label for="setujui-semua" class="mr-1 disetujui user-select-none cursor-pointer" style="margin-bottom: 0" id="1">
                    Pilih
                  </label>
                  <input type="checkbox" id="setujui-semua" class="cursor-pointer">
                </th>
                <th>Details</th>
                <th>No.</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Program Studi</th>
                <th>Waktu Pengajuan</th>
                <th>Jenis Pengajuan</th>
                @if($home['cmode'] == config('constants.users.fakultas'))
                  <th>No. Surat</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($verifikasi['all_pengajuan'] as $index => $pengajuan)
                @if(isset($pengajuan->nim))
                  <tr>
                    <td>
                      <input type="checkbox" name="status_persetujuan[]" id="checklist" {{ ($pengajuan->status_pengajuan === 5) ? 'checked' : '' }}>
                    </td>

                    <td>
                      <a href="{{ route('data-pengajuan.show', base64_encode(base64_encode($pengajuan->nim))) }}" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-eye-slash" id="button_{{ $pengajuan->nim }}"></i>
                      </a>
                    </td>

                    <td>{{ $loop->iteration }}</td>

                    <input type="hidden" name="id[]" value="{{ $pengajuan->id }}">
                    <input type="hidden" name="nim[]" value="{{ $pengajuan->nim }}">
                    <td>{{ $pengajuan->nim }}</td>
                    <td>{{ $pengajuan->nama }}</td>

                    <td>{{ $pengajuan->nama_prodi }}</td>
                    <td>{{ date('d/M/Y', strtotime($pengajuan->created_at)) }}</td>

                    <input type="hidden" name="jenis_pengajuan[]" value={{ ($pengajuan->jenis_pengajuan === 1) ? 1 : 2 }}>
                    <td>{{ ($pengajuan->jenis_pengajuan === 1) ? 'Cuti' : 'Pengunduran Diri' }}</td>

                    @if($home['cmode'] == config('constants.users.fakultas'))
                      <td>
                        <input type="text" name="no_surat[]" id="no_surat" placeholder="masukkan no surat..." class="form-control" value={{ ($pengajuan->no_surat !== null) ? $pengajuan->no_surat : '' }}>
                      </td>
                    @endif
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </form>
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

      $('#menu-bar').click(function() {
        $('#pilih-semua').toggle();
      })

      $('#setujui-semua').click(function() {
        var disetujui = $('.disetujui').attr('id');
        $('input[type="checkbox"]').prop('checked', this.checked).val($(this).is(':checked') ? disetujui : '');
      })

      $('#tolak-semua').click(function() {
        var ditolak = $('.ditolak').attr('id');
        $('input[type="checkbox"]').prop('checked', this.checked).val($(this).is(':checked') ? ditolak : '');
      })

      $('input[type="checkbox"]').click(function() {
        $(this).val($(this).is(':checked') ? 1 : '');
      })

      $('#pilih').removeClass('sorting_asc');
    });
  </script>
@endsection
