@extends('layouts.main')

@section('content')
  <div class="container grid p-2 gap-4">
    @include('partials.header')

    <div class="bg-slate-50 shadow-md p-3 rounded-md overflow-x-scroll">
      @include('flash-message')

      <div>
        <table class="table" id="tabel-md">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">NIM</th>
              <th scope="col">Nama</th>
              <th scope="col">Program Studi</th>
              <th scope="col">Status Pengajuan</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pengunduran_diri as $index => $md)
              @if(isset($md->nim))
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $md->nim }}</td>
                  <td>{{ $md->nama }}</td>
                  <td>{{ $md->studyProgram->nama_prodi }}</td>
                  <td>
                    <span class="bg-warning px-2 py-1 rounded-lg">{{ $md->refStatusPengajuan->keterangan_md }}</span>
                  </td>

                  <form action="{{ route('pengunduran-diri.destroy', $md->id) }}" method="POST">
                    {{-- @csrf
                    @method('DELETE') --}}
                    <td>
                      <button type="button" class="btn btn-danger hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out rounded-md" data-bs-toggle="modal" data-bs-target="#modal_{{ $md->id }}" {{ ($md->status_pengajuan !== 0) ? 'disabled' : '' }} onclick="()=>alert('yakin ingin hapus?')" >
                        <i class="fa-solid fa-trash-can"></i>
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="modal_{{ $md->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered"">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Batal Ajukan Pengunduran Diri</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Apakah anda yakin ingin membatalkan pengunduran diri?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                                <i class="fa-solid fa-ban"></i>
                                <span class="hidden lg:inline-block">Batal</span>
                              </button>

                              @csrf
                              @method('DELETE')
                              {{ $md->id }}
                              <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-trash-can"></i>
                                <span class="hidden lg:inline-block">Hapus</span>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </form>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="button">
      <a class="btn btn-warning hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out" href="{{ url('home') }}">
        <i class="nav-icon fa-solid fa-circle-arrow-left"></i>
        Kembali
      </a>
    </div>
  </div>
@endsection

@section('script')
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
@endsection
