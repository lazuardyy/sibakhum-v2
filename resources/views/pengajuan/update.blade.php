<div class="modal-dialog modal-dialog-centered modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Detail Pengajuan Cuti</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    {{-- {{ dd($pengajuan['pengunduran_diri']) }} --}}
    <div class="modal-body">
      {{-- {{ dd($md) }} --}}
      @if($pengajuan['cuti'] !== null)
        @foreach($pengajuan['pengajuan_cuti'] as $pengajuan)
          @include('verifikasi.row-form')
        @endforeach

      @else
        @foreach($pengajuan['pengunduran_diri'] as $pengajuan)
          @include('verifikasi.row-form')
        @endforeach
      @endif
      {{-- @if($pengajuan['pengajuan_cuti'] !== [] || $pengajuan['pengunduran_diri'] !== []) --}}


        {{-- @if($pengajuan['pengunduran_diri'] !== [])
          @foreach($pengajuan['pengunduran_diri'] as $pengajuan)
            @include('verifikasi.row-form')
          @endforeach
        @endif --}}
      {{-- @endif --}}

      <div class="modal-footer" style="padding: 0; margin-top:2rem">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
          <span class="">Batal</span>
        </button>

        <button type="submit" class="btn btn-primary">
          <span class="">Ajukan</span>
        </button>

      </div>
    </div>
  </div>
</div>



