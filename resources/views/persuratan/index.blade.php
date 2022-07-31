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

  <form action="{{ $route }}" method="post" enctype="multipart/form-data">
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
                <x-button.button-submit type="button" data-bs-dismiss="modal" buttonName="Batal" buttonColor="red" buttonIcon="fa-solid fa-ban"/>
                <x-button.button-submit type="submit" buttonName="Proses" buttonColor="green" buttonIcon="fa-solid fa-paper-plane" data-toggle="tooltip" data-placement="top" title="Verifikasi Data"/>
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
              <th>Jenis Pengajuan</th>
              <th>Pilih File</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($verifikasi['pengajuan_mhs'] as $index => $pengajuan)
              @if($pengajuan->jenis_pengajuan == 2 || ($pengajuan->jenis_pengajuan == 1 &&$pengajuan->status_pembayaran != 0))
                <tr>
                  @if(($pengajuan->status_pengajuan != 3))
                    <td class="text-center">
                      <input type="checkbox" name="id_pengajuan[]" value="{{ $pengajuan->id }}" id="checklist_{{ $pengajuan->id }}" @checked(old('active', ($pengajuan->status_pengajuan == 7) ? true : false))>
                      <input type="hidden" name="persetujuan[]" value="1">
                    </td>
                  @else
                    <td class="text-center">
                      <span><i class="fa-solid fa-check"></i></span>
                    </td>
                  @endif

                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $pengajuan->nim }}</td>
                  <td>{{ $pengajuan->nama }}</td>
                  <td>{{ $pengajuan->jenis_pengajuan === 1 ? 'Cuti' : 'Pengunduran Diri' }}</td>
                  <td>
                    @if($pengajuan->refFilePengajuan->file_permohonan_md === null)
                      <input class ='form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none'
                        type="file"
                        id="file_sk"
                        required
                        aria-describedby="file_sk"
                        placeholder="Pilih File SK"
                        name="{{ $home['cmode'] == config('constants.users.fakultas') ? 'file_permohonan_md[]' : 'file_sk[]' }}"
                      >
                    @else
                      {{ basename($pengajuan->refFilePengajuan->file_permohonan_md)  }}
                    @endif
                  </td>

                  <td>
                    <span class="btn btn-{{ $pengajuan->refFilePengajuan->file_permohonan_md !== null ? 'success' : 'warning' }}">{{ ($pengajuan->refFilePengajuan->file_permohonan_md !== null) ? 'Terkirim' : 'Belum dikirim' }}</span>
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
        $('#keterangan').text('Apakah anda sudah yakin dengan file yang dikirim?');
        $('[name="persetujuan[]"]').val(1);
      })

      $('#tolak-button').click(function () {
        $('#setujuModal').attr('id', 'tolakModal');
        $('#keterangan').text('Apakah anda yakin ingin menolak data terpilih?');
        $('[name="persetujuan[]"]').val(2);
      })
    });
  </script>
@endsection