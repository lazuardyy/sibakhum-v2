@extends('layouts.main')

@section('content')
  <div class="container grid">
    @include('partials.header')
    @include('flash-message')

    <div class="bg-slate-50 shadow-md p-3 rounded-md overflow-x-scroll">
      <table class="table" id="tabel-dosen">
        <thead>
          <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">NIM</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Program Studi</th>
            <th colspan="2" class="text-center">Waktu Pengajuan</th>
            <th rowspan="2">Aksi</th>
          </tr>
          <tr>
            <th>Pengajuan</th>
            <th>Persetujuan</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pengajuan_cuti as $index => $pengajuan)
            @if(isset($pengajuan->nim))
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pengajuan->nim }}</td>
                <td>{{ $pengajuan->nama}}</td>
                <td>{{ $nama_prodi }}</td>

                <td>{{ $pengajuan->created_at->format("M/d/Y") }}</td>
                <td>{{ ($pengajuan->status_pengajuan === 0) ? 'Menunggu Persetujuan' : $pengajuan->refStatusPengajuan->status_pengajuan_cuti }}</td>
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
                      <div class="form-body">
                        <div class="row form-group" style="margin-bottom: 0">
                          <div class="col">
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
                              @if(session('user_cmode') == '2')
                                <p>Status Persetujuan</p>
                              @endif
                          </div>
                          <div class="col">
                              <p>: {{ $pengajuan->nim }}</p>
                              <p>: {{ $pengajuan->nama }}</p>
                              <p>: {{ ($pengajuan->jenis_kelamin === 0) ? 'Laki-Laki' : 'Perempuan' }}</p>
                              <p>: {{ $nama_fakultas }}</p>
                              <p>: {{ $pengajuan->studyProgram->nama_prodi }}</p>
                              <p>: {{ $pengajuan->no_telp }}</p>
                              <p>: {{ $pengajuan->tahun_angkatan }}</p>
                              <p>: {{ $pengajuan->semester }}</p>
                              <p>: {{ ($pengajuan->jenis_pengajuan == 1) ? 'Cuti' : '' }}</p>
                              <p>: {{ $pengajuan->keterangan }}</p>
                              <p>: {{ $pengajuan->created_at->format("M/d/Y")  }}</p>
                              <p>: {{ $pengajuan->created_at->format("M/d/Y")  }}</p>
                            {{-- <div class="col-auto"> --}}


                            {{-- </div> --}}
                          </div>
                        </div>

                        <form action="{{ route('data-cuti.store') }}" method="POST">
                          @csrf
                          <div class="mb-1">
                            <label for="status_pengajuan">Pilih Status Persetujuan</label>
                            <select class="form-control col status" id="status_persetujuan_{{ $pengajuan->nim }}" name="status_persetujuan"
                              {{ ($pengajuan->status_pengajuan != '2') ? '' : 'disabled' }}
                              {{ ($pengajuan->status_pengajuan != '4') ? '' : 'disabled' }}>
                              <option value="0">Pilih Status Persetujuan</option>
                              <option value="1">Disetujui</option>
                              <option value="2">Ditolak</option>
                            </select>
                          </div>

                          <div class="row form-group" style="margin-bottom: 0">
                            <div class="col w-100 alasan" id="alasan" style="display: none">
                              <input type="hidden" name="nim"  value="{{ $pengajuan->nim }}">
                              <input type="hidden" name="jenis_pengajuan"  value="{{ $pengajuan->jenis_pengajuan }}">

                              <textarea class="form-control col" rows="3" cols="50" name="alasan" placeholder="Beri alasan bila pengajuan ditolak" style="resize: none" rows="5"></textarea>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger text-white font-medium leading-tight rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0" data-bs-dismiss="modal">Batal</button>

                            <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Verifikasi Data" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin dengan status terpilih ?')"><i class="fas fa-arrow"></i> Proses</button>
                          </div>
                        </div>
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
