@extends('layouts.main')

@section('content')
  <div class="container">
    @include('partials.header')
    @include('flash-message')

    @if($home['cmode'] == config('constants.users.fakultas') || $home['cmode'] == config('constants.users.dekanat') || $home['cmode'] == config('constants.users.wakil_rektor'))
      @include('verifikasi.verifikasi_all')
    @else
      @include('bakhum.bakhum_verifikasi')
    @endif
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
            $(`#${alasan}`).show();

          }
          else{
            var alasan = $('.alasan').attr('id');
            $(`#${alasan}`).hide();
          }
      });

      $('#menu-bar').click(function() {
        $('#pilih-semua').toggle();
      })

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
        $('#alasan').remove();
      })

      $('#tolak-button').click(function () {
        $('#setujuModal').attr('id', 'tolakModal');
        $('#keterangan').text('Apakah anda yakin ingin menolak data terpilih?');
        $('[name="persetujuan[]"]').val(2);

        $('#alasan').remove();

        $('.modal-body').append(`
          <textarea class="form-control alasan" id='alasan' rows="3" cols="50" name="alasan" placeholder="Beri alasan penolakan" style="resize: none;" rows="5"></textarea>
        `)
      })

      $('[name="id_pengajuan[]"]').each(function (i, d) {
        // console.log($(this).val());
        var id_pengajuan = $(this).val();
        // return id_pengajuan;
      })

      $('[name="jenis_pengajuan[]"]').each(function (e) {
        var jenis_pengajuan = $(this).val();
        // console.log(jenis_pengajuan);
      })
    });
  </script>
@endsection
