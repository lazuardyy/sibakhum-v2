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
          @foreach($pengunduran_diri as $index => $pengajuan)
            @if(isset($pengajuan->nim))
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pengajuan->nim }}</td>
                <td>{{ $pengajuan->nama}}</td>
                <td>{{ $pengajuan->studyProgram->nama_prodi }}</td>

                <td>{{ $pengajuan->created_at->format("M/d/Y") }}</td>
                <td>{{ ($pengajuan->status_pengajuan === 0) ? 'Menunggu Persetujuan' : $pengajuan->status_pengajuan }}</td>
                <td>
                  <button type="button" class="btn btn-primary  btn-sm" data-bs-toggle="modal" data-bs-target="#modal_{{ $pengajuan->id }}" id="details">
                    <i class="fa-solid fa-eye-slash" id="awal"></i>
                    <i class="fa-solid fa-eye" style="display:none" id="muncul"></i>
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

                    <form action="{{ route('data-cuti.store') }}" method="POST">
                      @csrf
                      <div class="modal-body">
                        <div class="form-body">
                          <div class="row form-group" style="margin-bottom: .5rem">
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
                                <p>Status Persetujuan</p>
                            </div>
                            <div class="col">
                                <p>: {{ $pengajuan->nim }}</p>
                                <p>: {{ $pengajuan->nama }}</p>
                                <p>: {{ $pengajuan->jenis_kelamin }}</p>
                                <p>: {{ $nama_fakultas }}</p>
                                <p>: {{ $pengajuan->studyProgram->nama_prodi }}</p>
                                <p>: {{ $pengajuan->no_telp }}</p>
                                <p>: {{ $pengajuan->tahun_angkatan }}</p>
                                <p>: {{ $pengajuan->semester }}</p>
                                <p>: {{ ($pengajuan->jenis_pengajuan == 1) ? 'Cuti' : 'Pengunduran Diri' }}</p>
                                <p>: {{ $pengajuan->keterangan }}</p>
                                <p>: {{ $pengajuan->created_at->format("M/d/Y")  }}</p>
                              {{-- <div class="col-auto"> --}}
                                <select class="form-control col" id="status_persetujuan" name="status_persetujuan" name="status_persetujuan">
                                  <option value="0">Pilih Status Persetujuan</option>
                                  <option value="1">Disetujui</option>
                                  <option value="2">Ditolak</option>
                                </select>
                              {{-- </div> --}}
                            </div>
                          </div>

                          <div class="row form-group" style="margin-bottom: 0">
                            <div class="col w-100" id="alasan" style="display: none">
                              <input type="hidden" name="nim"  value="{{ $pengajuan->nim }}">
                              <input type="hidden" name="jenis_pengajuan"  value="{{ $pengajuan->jenis_pengajuan }}">

                              <textarea class="form-control col" rows="3" cols="50"  name="alasan" placeholder="Beri alasan bila pengajuan ditolak" style="resize: none" rows="5"></textarea>
                            </div>
                          </div>
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Verifikasi Data" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin dengan status terpilih ?')"><i class="fas fa-arrow"></i> Proses</button>
                      </div>

                    </form>
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
      $('#status_persetujuan').on('change',function(){
          if($(this).val() == 2){
            $("#alasan").show()
          }
          else{
            $("#alasan").hide()
          }
      });

      // $('#details').on('click',function(){
      //   $('#awal').hide()
      //   $("#muncul").show()
      // });
    });
  </script>
@endsection
