@extends('layouts.main')

@section('content')
<div class="container">
  @include('partials.header')
  @include('flash-message')


    <div class="card">
      <div class="card-header">
        <div class="card-title">
          <label for="disetujui" type="button" data-bs-toggle="modal" data-bs-target="#setujuModal" class="btn btn-outline-success mr-1" style="margin-bottom: 0" id="setuju-button">
            <i class="fa-solid fa-paper-plane mr-1"></i>
            Simpan
          </label>
          <input type="checkbox" id="disetujui" class="d-none">
        </div>

        <div class="modal fade" id="setujuModal" tabindex="-1" aria-labelledby="submitModal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="justify-content: start; align-items:center; gap:.5rem;">
                <div class="bg-warning d-flex align-items-center gap-1 pl-2 pr-2 rounded-md">
                  <i class="fa-solid fa-triangle-exclamation"></i>
                  <h5 class="modal-title" id="submitModal">Simpan Data Pengajuan</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <h6 id="keterangan">Apakah anda yakin dengan ingin menyimpan data terpilih?</h6>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger text-white font-medium leading-tight rounded-sm shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0" data-bs-dismiss="modal">Batal</button>

                <button type="button" class="btn btn-primary text-white font-medium leading-tight rounded-sm shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0" data-toggle="tooltip" data-placement="top" title="Verifikasi Data" onclick="document.getElementById('form-data').submit()">Proses</button>
              </div>
            </div>
          </div>
        </div>

        <div class="card-tools">
          <form action="{{ route('data-mhs.semua') }}" method="GET" id="filter">
            <select class="form-select btn border-1 border-sky-500 text-left" name="jenis_pengajuan">
              <option selected>Filter Data...</option>
              <option value="semua">Semua</option>
              <option value="cuti">Cuti</option>
              <option value="pengunduran_diri">Pengunduran Diri</option>
            </select>

            <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('filter').submit()"data-toggle="tooltip" title="Search"><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
        </div>
      </div>

      <div class="card-body p-3 overflow-x-scroll">
        <form action="{{ route('data-mhs.verifikasi-bakhum') }}" method="post" id="form-data">
        @csrf
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
                <th>Surat Pengajuan</th>
                <th>No. Surat Fakultas</th>
                <th>No. Surat Bakhum</th>
                <th>Status Pembayaran</th>
                {{-- @if($status_pembayaran != '0') --}}
                <th>Cetak Surat</th>
                {{-- @endif --}}
              </tr>
            </thead>
            <tbody>
              @foreach($verifikasi['pengajuan_mhs'] as $index => $pengajuan)
                @if($pengajuan->file_sk === null)
                  <tr>
                    <td>
                      <input type="checkbox" name="id_pengajuan[]" value="{{ $pengajuan->id }}" id="checklist_{{ $pengajuan->id }}" @checked(old('active', ($pengajuan->status_pengajuan == 6) ? true : false))>

                      <input type="hidden" name="jenis_pengajuan[]" value="{{ ($pengajuan->jenis_pengajuan === 1) ? 1 : 2 }}" id="checklist_{{ $pengajuan->id }}">
                      <input type="hidden" name="persetujuan[]" value="1">
                    </td>

                    <td>{{ $loop->iteration }}</td>

                    <input type="hidden" name="id[]" value="{{ $pengajuan->id }}">
                    <input type="hidden" name="jenis_pengajuan[]" value="{{ ($pengajuan->jenis_pengajuan === 1) ? 1 : 2 }}" id="checklist_{{ $pengajuan->id }}">


                    <td>{{ $pengajuan->nim }}</td>
                    <td>{{ $pengajuan->nama }}</td>

                    <td>{{ $pengajuan->nama_prodi }}</td>
                    <td>{{ ($pengajuan->jenis_pengajuan === 1) ? 'Cuti' : 'Pengunduran Diri' }}</td>
                    <td>
                      @if($pengajuan->jenis_pengajuan === 2)
                        <a href="{{ route('file_pengajuan.show', $pengajuan->file_pengajuan_md) }}">{{ $pengajuan->nama }}_{{ $pengajuan->jenis_pengajuan == '2' ? 'md' : '' }}</a>
                      @else
                        <span>-</span>
                      @endif
                    </td>
                    <td>
                      <input type="text" name="no_surat_fakultas[]" id="no_surat_{{ $pengajuan->id }}" placeholder="masukkan no surat..." class="form-control" value={{ ($pengajuan->no_surat_fakultas !== null) ? $pengajuan->no_surat_fakultas : '' }} readonly>
                    </td>
                    <td>
                      <input type="text" name="no_surat_bakhum[]" id="no_surat_{{ $pengajuan->id }}" placeholder="masukkan no surat..." class="form-control" value={{ ($pengajuan->no_surat_bakhum !== null) ? $pengajuan->no_surat_bakhum : '' }}>
                    </td>
                    <td>
                      <span class="btn {{ ($pengajuan->status_pembayaran == 0) ? 'btn-warning' : 'btn-success' }}">{{ ($pengajuan->status_pembayaran == 0) ? 'Belum Bayar' : 'Sudah Bayar' }}</span>
                    </td>
                    @if($pengajuan->status_pembayaran != 0)
                      <td>
                        <a href="{{ route('data-mhs.cetak', $pengajuan->id) }}" target='_blank' class="btn btn-primary btn-sm hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out rounded-md" >
                          <i class="fa-solid fa-print"></i>
                        </a>
                      </td>
                    @endif
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
      </form>
      </div>
    </div>
</div>
@endsection

@section('script')
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script>
    $(document).ready(function() {

      $('#selectAll').click(function() {
        var disetujui = $('.disetujui').attr('id');
        $('input[type="checkbox"]').prop('checked', this.checked);
      })

      $('#tolak-semua').click(function() {
        var ditolak = $('.ditolak').attr('id');
        $('input[type="checkbox"]').prop('checked', this.checked).val($(this).is(':checked') ? ditolak : '');
      })

      $('#pilih').removeClass('sorting_asc');

      $('#setuju-button').click(function () {
        $('#tolakModal').attr('id', 'setujuModal');
        $('#keterangan').text('Apakah anda yakin ingin menyetujui data terpilih?');
        $('[name="persetujuan[]"]').val(1);
      })

      $('#tolak-button').click(function () {
        $('#setujuModal').attr('id', 'tolakModal');
        $('#keterangan').text('Apakah anda yakin ingin menolak data terpilih?');
        $('[name="persetujuan[]"]').val(2);
      })

      $('[name="jenis_pengajuan[]"]').each(function (e) {
        var jenis_pengajuan = $(this).val();
        console.log(jenis_pengajuan);
      })
    });
  </script>
@endsection

