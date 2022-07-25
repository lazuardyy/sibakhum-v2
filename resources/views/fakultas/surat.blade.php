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
      <div class="card-body p-3 overflow-x-scroll">
        <table class="table compact" id="table-all-data">
          <thead>
            <tr>
              <th>No.</th>
              <th>NIM</th>
              <th>Nama</th>
              <th>Surat Masuk</th>
              <th>Download</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pengajuan_mhs as $index => $pengajuan)
              @if($pengajuan->status_pembayaran != '0')
                <tr>
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
                        name="file_sk"
                      >
                    @else
                      <a href="{{ route('file_pengajuan.show', $pengajuan->file_sk) }}">{{ $pengajuan->nama }}_{{ $pengajuan->nim }}_Surat Keterangan {{ $pengajuan->jenis_pengajuan == 1 ? 'Cuti' : 'Pengunduran Diri' }}</a>
                    @endif
                  </td>
                  <td class="text-center">
                    <a href="{{ route('file_pengajuan.show', $pengajuan->file_sk) }}" download class="btn btn-sm btn-primary">
                      <i class="fa-solid fa-download">
                    </a>
                    {{-- <a href="{{ route('data-mhs.download-sk', $pengajuan->id) }}" class="btn btn-primary btn-sm">
                      <i class="fa-solid fa-download"></i>
                    </a> --}}
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
