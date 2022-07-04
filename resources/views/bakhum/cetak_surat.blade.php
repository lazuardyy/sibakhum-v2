@extends('layouts.main')

@section('content')
<div class="container">
  @include('partials.header')
  @include('flash-message')

  <form action="{{ route('data-pengajuan.store') }}" method="post">
    @csrf
    <div class="card">
      <div class="card-header">
        <label for="disetujui" type="button" data-bs-toggle="modal" data-bs-target="#setujuModal" class="btn btn-outline-success" style="margin-bottom: 0" id="setuju-button">
          <i class="fa-solid fa-paper-plane mr-1"></i>
          Simpan
        </label>
        <input type="checkbox" id="disetujui" class="d-none">

        {{-- <label for="ditolak" type="button" data-bs-toggle="modal" data-bs-target="#tolakModal" class="btn btn-outline-danger" style="margin-bottom: 0" id="tolak-button">
          <i class="fa-solid fa-print mr-1"></i>
          Cetak Surat
        </label> --}}
        <input type="checkbox" id="ditolak" class="d-none">

        <div class="modal fade" id="setujuModal" tabindex="-1" aria-labelledby="submitModal" aria-hidden="true">
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
                <h6 id="keterangan">Apakah anda yakin dengan status persetujuan yang dipilih?</h6>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger text-white font-medium leading-tight rounded-sm shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0" data-bs-dismiss="modal">Batal</button>

                <button type="submit" class="btn btn-primary text-white font-medium leading-tight rounded-sm shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0" data-toggle="tooltip" data-placement="top" title="Verifikasi Data">Proses</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card-body p-3 overflow-x-scroll">
        <table class="table compact" id="table-all-data">
          <thead>
            <tr>
              <th id="pilih">
                <label for="selectAll" class="mr-1 disetujui user-select-none cursor-pointer" style="margin-bottom: 0" id="1">
                  Pilih
                </label>
                <input type="checkbox" id="selectAll" value="select" class="cursor-pointer">
              </th>
              <th>No.</th>
              <th>NIM</th>
              <th>Nama</th>
              <th>Program Studi</th>
              <th>Jenis Pengajuan</th>
              <th>No. Surat Fakultas</th>
              <th>No. Surat Bakhum</th>
              <th>Cetak Surat</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pengajuan_mhs as $index => $pengajuan)
              @if(isset($pengajuan->nim))
                <tr>
                  <td>
                    @if(  ($home['cmode'] == config('constants.users.dekanat') && ($pengajuan->status_pengajuan < 4 && $pengajuan->status_pengajuan <= 24)) || ($home['cmode'] == config('constants.users.wakil_rektor') && ($pengajuan->status_pengajuan < 5 && $pengajuan->status_pengajuan <= 24)) || ($home['cmode'] == config('constants.users.fakultas') && ($pengajuan->status_pengajuan < 6 && $pengajuan->status_pengajuan <= 24)) )
                      <input type="checkbox" name="id_pengajuan[]" value="{{ $pengajuan->id }}" id="checklist_{{ $pengajuan->id }}">
                    @endif

                    <input type="hidden" name="jenis_pengajuan[]" value="{{ ($pengajuan->jenis_pengajuan === 1) ? 1 : 2 }}" id="checklist_{{ $pengajuan->id }}">
                    <input type="hidden" name="persetujuan[]" value="1">


                    @if( ($home['cmode'] == config('constants.users.dekanat') && $pengajuan->status_pengajuan >= 3 || $pengajuan->status_pengajuan === 23) || ($home['cmode'] == config('constants.users.wakil_rektor') && $pengajuan->status_pengajuan >= 4 || $pengajuan->status_pengajuan === 24) )

                      <label for="checklist_{{ $pengajuan->id }}" class="text-sm user-select-none">
                        <span class="text-{{ ($pengajuan->status_pengajuan <= 7) ? 'success' : 'danger' }}">{{ ($pengajuan->status_pengajuan <= 7) ? 'disetujui ' . (($pengajuan->status_pengajuan == 3) ? 'wd 1' : 'wr 1') : 'ditolak' }}</span>
                      </label>

                    @elseif($home['cmode'] == config('constants.users.fakultas'))
                    <label for="checklist_{{ $pengajuan->id }}" class="text-sm user-select-none">
                      <span class="text-{{ ($pengajuan->status_pengajuan !== 5) ? 'warning' : 'success' }}">{{ ($pengajuan->status_pengajuan == 5) ? 'selesai diproses' : 'menunggu diproses' }}</span>
                    </label>

                    @else
                    <label for="checklist_{{ $pengajuan->id }}" class="text-sm user-select-none">
                      <span class="">{{ ($home['cmode'] == config('constants.users.dekanat')) ? 'menunggu persetujuan' : 'menunggu diproses' }}</span>
                    @endif
                  </td>

                  <td>{{ $loop->iteration }}</td>

                  <input type="hidden" name="id[]" value="{{ $pengajuan->id }}">
                  {{-- <input type="hidden" name="jenis_pengajuan[]" value="{{ $pengajuan->jenis_pengajuan }}"> --}}
                  <td>{{ $pengajuan->nim }}</td>
                  <td>{{ $pengajuan->nama }}</td>

                  <td>{{ $pengajuan->nama_prodi }}</td>
                  <td>{{ ($pengajuan->jenis_pengajuan === 1) ? 'Cuti' : 'Pengunduran Diri' }}</td>
                  <td>
                    <input type="text" name="no_surat[]" id="no_surat_{{ $pengajuan->id }}" placeholder="masukkan no surat..." class="form-control" value={{ ($pengajuan->no_surat_fakultas !== null) ? $pengajuan->no_surat_fakultas : '' }} readonly>
                  </td>
                  <td>
                    <input type="text" name="no_surat[]" id="no_surat_{{ $pengajuan->id }}" placeholder="masukkan no surat..." class="form-control" value={{ ($pengajuan->no_surat !== null) ? $pengajuan->no_surat : '' }}>
                  </td>
                  <td>
                    <a href="{{ route('data-mhs.cetak', $pengajuan->id) }}" class="btn btn-primary btn-sm hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out rounded-md" >
                      <i class="fa-solid fa-print"></i>
                    </a>
                  </td>
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
