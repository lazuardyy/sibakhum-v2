@extends('layouts.main')

@section('content')
<div class="container grid p-2 pb-4">
  @include('partials.header')

  {{-- @foreach($history_cuti as $history)
    {{ $history }}
  @endforeach --}}

  <div class="card card-outline card-info">
    <div class="card-header">
      <h3 class="card-title">Riwayat Persetujuan</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      </div>
    </div>

    <div class="card-body">
      @if(isset($nama_mhs))
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <span class="text-md text-primary underline text-bold hover:text-blue-600">{{ date('d M Y', strtotime($created_at)) }} - {{ $nama_mhs }}</span>
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <div class="timeline">
                  <div>
                    {{-- <i class="fas fa-envelope bg-blue"></i> --}}
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($created_at)->diffForHumans() }} </span>
                      <h3 class="timeline-header text-bold">{{ ($jenis_pengajuan == 1) ? 'Pengajuan Cuti' : 'Pengunduran Diri'  }}</h3>
                      <div class="timeline-body">
                        <ul class="list-group list-group-flush">
                          @foreach($histories as $history)
                            <li class="list-group-item">
                              Pengajuan
                              atas nama <strong>{{ $history->pengajuanMhs->nama }}</strong>
                              <span class="lowercase">{{ $history->refStatusPengajuan->status_pengajuan_cuti }}</span> pada tanggal {{ date('d M Y', strtotime($history->updated_at)) }} pukul {{ date('h:i', strtotime($history->created_at)) }} WIB.
                              {{-- {{ $history->status_pengajuan }} --}}
                            </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div>
                    <i class="fas fa-envelope bg-blue"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @else
        <div class="alert alert">
          <h5 class="text-bold">
            <span class="text-md">
              Belum ada riwayat pengajuan cuti atau pengunduran diri.
            </span>
          </h5>
        </div>
      @endif
    </div>


    {{-- @if($id_cuti_history && $id_md_history)
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
                      atas nama <strong>{{ $history->pengajuanMhs->nama }}</strong>
                      telah {{ $history->refStatusPengajuan->status_pengajuan_cuti }} pada tanggal {{ date('d M Y', strtotime($history->updated_at)) }} pukul {{ date('h:i', strtotime($history->created_at)) }} WIB.
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
                    <li>Pengajuan atas nama <strong>{{ $history->pengajuanMhs->nama }}</strong> telah {{ $history->refStatusPengajuan->status_pengunduran_diri }} pada tanggal {{ date('d M Y', strtotime($history->updated_at)) }} pukul {{ date('h:i', strtotime($history->created_at)) }} WIB.
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
                    <li>Pengajuan atas nama <strong>{{ $history->pengajuanMhs->nama }}</strong>
                      telah {{ $history->refStatusPengajuan->status_pengajuan_cuti }} pada tanggal {{ date('d M Y', strtotime($history->updated_at)) }} pukul {{ date('h:i', strtotime($history->created_at)) }} WIB.
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

    @elseif($id_md_history)
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
                    <li>Pengajuan atas nama <strong>{{ $history->pengajuanMhs->nama }}</strong>
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
      @endforeach
    @else
      <div class="card-body">
        <span>Belum ada riwayat persetujuan.</span>
      </div>
    @endif --}}
  </div>
</div>
@endsection
