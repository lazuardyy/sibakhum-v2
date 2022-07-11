@extends('layouts.main')

@section('content')
<div class="container grid p-2 pb-4">
  @include('partials.header')

  <div class="bg-slate-50 shadow-md p-3 rounded-md overflow-x-auto">
    <table class="table" id="tabel-history">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">Jenis Pengajuan</th>
          {{-- <th scope="col">Persetujuan</th> --}}
          <th scope="col">Status Persetujuan</th>
          <th scope="col">Tanggal Persetujuan</th>
          @if($home['cmode'] != config('constants.users.fakultas') && $home['cmode'] != config('constants.users.bakhum'))
            <th scope="col">Alasan</th>
          @endif
        </tr>
      </thead>
      <tbody>
            @php $i = 0; @endphp
        @foreach($histories as $history)
          @foreach($history as $key => $his)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>{{ $his->pengajuanMhs->nama }}</td>
              <td>{{ ($his->pengajuanMhs->jenis_pengajuan == 1) ? 'Cuti' : 'Pengunduran Diri' }}</td>
              {{-- <td>{{ ($his->v_mode == config('constants.users.prodi')) ? 'Koordinator Prodi' : '' }}</td> --}}
              @if($home['cmode'] != config('constants.users.fakultas') && $home['cmode'] != config('constants.users.bakhum'))
                <td>{{ ($his->status_pengajuan < 8) ? 'Disetujui' : 'Ditolak' }}</td>
              @else
                <td>{{ ($his->status_pengajuan < 8) ? 'Selesai diproses' : '' }}</td>
              @endif
              <td>{{ $his->created_at->format('d M Y') }} <br> Pukul {{ $his->updated_at->format('H:i') }} WIB</td>

              @if($home['cmode'] != config('constants.users.fakultas') && $home['cmode'] != config('constants.users.bakhum'))
                <td>{{ $his->alasan }}</td>
              @endif
            </tr>
            @php $i++; @endphp
          @endforeach
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
@section('script')
  {{-- <script src="{{ asset('js/script.js') }}"></script> --}}
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
@endsection
