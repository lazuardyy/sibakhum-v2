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
            <form action="{{ route('pengajuan-cuti.update',  $pengajuan->id) }}" method="POST">
              @csrf
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pengajuan->nim }}</td>
                <td>{{ $pengajuan->nama}}</td>
                <td>{{ $pengajuan->studyProgram->nama_prodi }}</td>

                <td>{{ $pengajuan->created_at->format("M/d/Y") }}</td>
                <td>-</td>
                <td>
                  <button type="button" class="btn btn-primary  btn-sm" data-bs-toggle="modal" data-bs-target="#modal_{{ $pengajuan->id }}">
                    <i class="fa-solid fa-eye-slash"></i>
                  </button>
                </td>

                <!-- Modal -->
                <div class="modal fade" id="modal_{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modal_{{ $pengajuan->id }}">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        ...
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- <td>
                    <div class="pretty p-icon p-round p-plain p-smooth">
                      <input type="radio" name="status_pengajuan" value="1">
                      <div class="state p-primary-o">
                          <i class="icon fa-solid fa-check"></i>
                          <label>Disetujui</label>
                      </div>
                    </div>

                    <div class="pretty p-icon p-round p-plain p-smooth">
                        <input type="radio" name="status_pengajuan" value="0">
                        <div class="state p-danger-o">
                            <i class="icon fa-solid fa-ban"></i>
                            <label>Ditolak</label>
                        </div>
                    </div>
                </td> --}}
              </tr>
            </form>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@section('script')
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
@endsection
