@extends('layouts.main')

@section('content')
  <div class="container grid p-2 gap-4">
    @include('partials.header')

    <div class="bg-slate-50 shadow-md p-3 rounded-md overflow-x-auto">
      @include('flash-message')

      <div>
        <table class="table" id="tabel-cuti">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">NIM</th>
              <th scope="col">Nama</th>
              <th scope="col">Program Studi</th>
              <th scope="col">Tanggal Pengajuan</th>
              <th scope="col">Status Pengajuan</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pengajuan['pengajuan_cuti'] as $index => $pengajuan)
              @if(isset($pengajuan->nim))
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $pengajuan->nim }}</td>
                  <td>{{ $pengajuan->nama }}</td>
                  <td>{{ $pengajuan->nama_prodi }}</td>
                  <td>{{ $pengajuan->created_at->format('d M Y') }}</td>
                  <td class="flex gap-1 flex-col">
                    <span class="{{ ($pengajuan->status_pengajuan !== 0 && $pengajuan->status_pengajuan < 21) ? 'bg-success' : 'bg-red-400' }} px-2 py-1 rounded-lg">{{ $pengajuan->refStatusPengajuan->status_pengajuan_cuti }}</span>
                    <span class="bg-warning px-2 py-1 rounded-lg">{{ $pengajuan->refStatusPengajuan->keterangan_cuti }}</span>
                  </td>

                  <td>
                    @if($pengajuan->status_pengajuan !== 7)
                      <form action="{{ route('pengajuan-mhs.update', $pengajuan->id) }}" method="POST" style="display: inherit">
                        @csrf
                        @method('PUT')

                        <button type="button" class="mr-1 btn btn-sm btn-warning hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out rounded-md" data-bs-toggle="modal" data-bs-target="#update_{{ $pengajuan->id }}" {{ ($pengajuan->status_pengajuan !== 0) ? 'disabled' : '' }}>
                          <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                        <div class="modal fade" id="update_{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="update_{{ $pengajuan->id }}" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Detail Pengajuan Cuti</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>

                              <div class="modal-body">
                                  @include('verifikasi.row-form')
                                <div class="modal-footer" style="padding: 0; margin-top:2rem">
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                    <span class="">Batal</span>
                                  </button>

                                  <button type="submit" class="btn btn-primary" {{ ($pengajuan->status_pengajuan !== 0) ? 'disabled' : '' }}>
                                    <span class="">Ajukan</span>
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                      </form>

                      <form action="{{ route('pengajuan-mhs.destroy', $pengajuan->id) }}" method="POST" style="display: inherit">
                        <button type="button" class="btn btn-danger btn-sm hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out rounded-md" data-bs-toggle="modal" data-bs-target="#modal_{{ $pengajuan->id }}" {{ ($pengajuan->status_pengajuan !== 0) ? 'disabled' : '' }}>
                          <i class="fa-solid fa-trash-can"></i>
                        </button>


                        <!-- Modal -->
                        <div class="modal fade" id="modal_{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Batal Ajukan Cuti</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                Apakah anda yakin ingin membatalkan pengajuan cuti?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                                  <i class="fa-solid fa-ban"></i>
                                  <span class="hidden lg:inline-block">Batal</span>
                                </button>

                                @csrf
                                @method('DELETE')
                                {{ $pengajuan->id }}
                                <button type="submit" class="btn btn-danger" {{ ($pengajuan->status_pengajuan !== 0) ? 'disabled' : '' }}>
                                  <i class="fa-solid fa-trash-can"></i>
                                  <span class="hidden lg:inline-block">Hapus</span>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    @else
                      <a href="{{ route('data-mhs.cetak', $pengajuan->id) }}" class="btn btn-primary btn-sm hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out rounded-md" data-bs-toggle="tooltip" title="Download SK Cuti">
                        <i class="fa-solid fa-print"></i>
                      </a>
                    @endif
                  </td>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="button">
      <a class="btn btn-primary hover:bg-blue-600 hover:shadow-lg focus:bg-blue-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-700 active:shadow-lg transition duration-150 ease-in-out" href="{{ url('home') }}">
        <i class="nav-icon fa-solid fa-circle-arrow-left"></i>
        Kembali
      </a>
    </div>
  </div>
@endsection

@section('script')
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
@endsection
