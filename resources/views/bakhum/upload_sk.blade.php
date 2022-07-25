@extends('layouts.main')

@section('content')
<div class="container">
  @include('partials.header')
  @include('flash-message')

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul style="margin-bottom: 0">
            @foreach ($errors->all() as $error)
             <li> <i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <form action="{{ route('data-mhs.upload-sk') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card">
      <div class="card-header">
        <label for="disetujui" type="button" data-bs-toggle="modal" data-bs-target="#setujuModal" class="btn btn-outline-success mr-1" style="margin-bottom: 0" id="setuju-button">
          <i class="fa-solid fa-paper-plane mr-1"></i>
          Kirim
        </label>
        <input type="checkbox" id="disetujui" class="d-none">

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
              <th>Pilih File</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($verifikasi['pengajuan_mhs'] as $index => $pengajuan)
              @if($pengajuan->status_pembayaran != '0')
                <tr>
                  <td>
                    @if(($pengajuan->status_pengajuan != 7))
                      <input type="checkbox" name="id_pengajuan[]" value="{{ $pengajuan->id }}" id="checklist_{{ $pengajuan->id }}" @checked(old('active', ($pengajuan->status_pengajuan == 7) ? true : false))>
                    @else
                      <span><i class="fa-solid fa-check"></i></span>
                    @endif

                    <input type="hidden" name="jenis_pengajuan[]" value="{{ ($pengajuan->jenis_pengajuan === 1) ? 1 : 2 }}" id="checklist_{{ $pengajuan->id }}">
                    <input type="hidden" name="persetujuan[]" value="1">
                  </td>

                  <td>{{ $loop->iteration }}</td>

                  <input type="hidden" name="id[]" value="{{ $pengajuan->id }}">
                  <input type="hidden" name="jenis_pengajuan[]" value="{{ ($pengajuan->jenis_pengajuan === 1) ? 1 : 2 }}" id="checklist_{{ $pengajuan->id }}">


                  <td>{{ $pengajuan->nim }}</td>
                  <td>{{ $pengajuan->nama }}</td>
                  <td>
                    @if($pengajuan->file_sk === null)
                      <input class ='form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none'
                        type="file"
                        id="file_sk"
                        required
                        aria-describedby="file_sk"
                        placeholder="Pilih File SK"
                        name="file_sk[]"
                      >
                    @else
                      {{ $pengajuan->file_sk }}
                    @endif
                  </td>
                  <td>
                    <span class="btn btn-{{ $pengajuan->file_sk !== null ? 'success' : 'warning' }}">{{ ($pengajuan->file_sk !== null) ? 'Terkirim' : 'Belum dikirim' }}</span>
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
