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

    @if($id_cuti_history)
      @foreach($history_cuti as $history)
        <div class="card-body">
          <div class="timeline">
            <div class="time-label">
              <span class="bg-green">
                {{ date('d M Y', strtotime($history->created_at)) }}
              </span>
            </div>
            <div>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i>
                  {{ \Carbon\Carbon::parse($history->updated_at)->diffForHumans() }}
                </span>

                <h3 class="timeline-header">Riwayat Persetujuan Cuti</h3>
                <div class="timeline-body">
                  <ul>
                    <li>Pengajuan
                      atas nama <strong>{{ $history->pengajuanCuti->nama }}</strong>
                      {{ $history->refStatusPengajuan->status_pengajuan_cuti }} pada tanggal {{ date('d M Y', strtotime($history->updated_at)) }} pukul {{ date('h:i', strtotime($history->created_at)) }} WIB.
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div>
              <i class="fas fa-envelope bg-blue"></i>
            </div>
          </div>
        </div>
      @endforeach

      {{-- @foreach($history_md as $history)
        <div class="card-body">
          <div class="timeline">
            <div class="time-label">
              <span class="bg-green">
                {{ date('d M Y', strtotime($history->created_at)) }}
              </span>
            </div>
            <div>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i>
                  {{ \Carbon\Carbon::parse($history->updated_at)->diffForHumans() }}
                </span>

                <h3 class="timeline-header">Riwayat Persetujuan Pengunduran Diri</h3>
                <div class="timeline-body">
                  <ul>
                    <li>Pengajuan atas nama <strong>{{ $history->pengunduranDiri->nama }}</strong> telah {{ $history->refStatusPengajuan->status_pengunduran_diri }} pada tanggal {{ date('d M Y', strtotime($history->updated_at)) }} pukul {{ date('h:i', strtotime($history->created_at)) }} WIB.
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div>
              <i class="fas fa-envelope bg-blue"></i>
            </div>
          </div>
        </div>
      @endforeach --}}

    @elseif($id_cuti_history)
      @foreach($history_cuti as $history)
        <div class="card-body">
          <div class="timeline">
            <div class="time-label">
              <span class="bg-green">
                {{ date('d M Y', strtotime($history->created_at)) }}
              </span>
            </div>
            <div>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i>
                  {{ \Carbon\Carbon::parse($history->updated_at)->diffForHumans() }}
                </span>

                <h3 class="timeline-header">Riwayat Persetujuan Cuti</h3>
                <div class="timeline-body">
                  <ul>
                    <li>Pengajuan atas nama <strong>{{ $history->pengajuanCuti->nama }}</strong>
                      {{ $history->refStatusPengajuan->status_pengajuan_cuti }} pada tanggal {{ date('d M Y', strtotime($history->updated_at)) }} pukul {{ date('h:i', strtotime($history->created_at)) }} WIB.
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div>
              <i class="fas fa-envelope bg-blue"></i>
            </div>
          </div>
        </div>
      @endforeach

    {{-- @elseif($id_md_history)
      @foreach($history_md as $history)
        <div class="card-body">
          <div class="timeline">
            <div class="time-label">
              <span class="bg-green">
                {{ date('d M Y', strtotime($history->created_at)) }}
              </span>
            </div>
            <div>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i>
                  {{ \Carbon\Carbon::parse($history->updated_at)->diffForHumans() }}
                </span>

                <h3 class="timeline-header">Riwayat Persetujuan Pengunduran Diri</h3>
                <div class="timeline-body">
                  <ul>
                    <li>Pengajuan atas nama <strong>{{ $history->pengunduranDiri->nama }}</strong>
                      telah {{ $history->refStatusPengajuan->status_pengunduran_diri }} pada tanggal {{ date('d M Y', strtotime($history->updated_at)) }} pukul {{ date('h:i', strtotime($history->created_at)) }} WIB.
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div>
              <i class="fas fa-envelope bg-blue"></i>
            </div>
          </div>
        </div>
      @endforeach --}}
    @else
      <div class="card-body">
        <span>Belum ada riwayat persetujuan.</span>
      </div>
    @endif
  </div>
</div>
@endsection
