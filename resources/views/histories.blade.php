@extends('layouts.main')

@section('content')
<div class="container grid p-2 pb-4">
  @include('partials.header')

  <div class="card card-outline card-info">
    <div class="card-header">
      <h3 class="card-title">Riwayat Persetujuan</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      </div>
    </div>

    @foreach($history_cuti as $history)
      @if(isset($history->id))
        <div class="card-body">
          <div class="timeline">
            <!-- Timeline time label -->
            <div class="time-label">
              <span class="bg-green">{{ $history->created_at->format('d M Y') }}</span>
            </div>
            <div>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> {{ $history->updated_at->diffForHumans() }}</span>

                <h3 class="timeline-header">Riwayat Persetujuan Cuti</h3>
                <div class="timeline-body">
                  <ul>
                    <li>Pengajuan
                      {{ ($history->jenis_pengajuan == '1') ? 'cuti' : '' }}
                      atas nama <strong>{{ $history->nama }}</strong>
                      telah {{ $history->refStatusPengajuan->status_pengajuan_cuti }} pada tanggal {{ $history->updated_at->format('d M Y') }} pukul {{ $history->updated_at->format('h:i') }} WIB.
                    </li>

                    {{-- <li>{{ $history->histories }}</li> --}}
                  </ul>
                </div>
              </div>
            </div>

            <div>
              <i class="fas fa-envelope bg-blue"></i>
            </div>
          </div>


        </div>
      @else
        <div class="card-body">
          <span>Belum ada riwayat persetujuan.</span>
        </div>
      @endif
    @endforeach
  </div>
</div>
@endsection
