<div class="row border-2 rounded border-amber-400 mt-2 px-2">
  <label for="status_persetujuan_{{ $pengajuan->nim }}">Form Persetujuan</label>
  <div class="alert alert-warning text-center">
    <ul class="list-unstyled text-left" style="margin-bottom: 0">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <span>Perhatian:</span>
        @if($home['cmode'] == '8')
          <li class="text-justify">Anda dapat melakukan perubahan persetujuan selama persetujuan yang anda pilih sebelumnya belum disetujui/ditolak oleh koordinator prodi.</li>
          @elseif($home['cmode'] == '2')
            <li class="text-justify">Anda dapat melakukan perubahan persetujuan selama persetujuan yang anda pilih sebelumnya belum disetujui/ditolak oleh wakil dekan 1.</li>
          @else
            <li class="text-justify">Anda dapat melakukan perubahan persetujuan selama persetujuan yang anda pilih sebelumnya belum disetujui/ditolak oleh wakil rektor 1.</li>
        @endif
    </ul>
  </div>

  <label for="status_persetujuan_{{ $pengajuan->id }}">Pilih Persetujuan</label>
  <div class="w-100 mb-2">
    @if($pengajuan->status_pengajuan === 0)
      <select class="form-control status" id="status_persetujuan" name="status_persetujuan">
        <option value="0">Pilih Status Persetujuan</option>
        <option value="1">Disetujui</option>
        <option value="2">Ditolak</option>
      </select>
    @elseif($home['cmode'] == '8')
      @if($pengajuan->status_pengajuan < 2 || $pengajuan->status_pengajuan >= 2 && $pengajuan->status_pengajuan <= 24)
        <div class="mb-2 form-control bg-{{ ($pengajuan->status_pengajuan <= 4 && $pengajuan->status_pengajuan <= 24) ? 'success' : 'danger'}}">
          {{ $pengajuan->refStatusPengajuan->status_pengajuan_cuti }}
        </div>

        @if($pengajuan->status_pengajuan < 2 || $pengajuan->status_pengajuan === 21)
          <select class="form-control status" id="status_persetujuan" name="status_persetujuan">
            <option value="0">Perbarui Status Persetujuan</option>
            <option value="1">Disetujui</option>
            <option value="2">Ditolak</option>
          </select>
        @endif
      @endif

    @elseif($home['cmode'] == '2')
      @if($pengajuan->status_pengajuan < 3 || $pengajuan->status_pengajuan >= 3 && $pengajuan->status_pengajuan <= 24)
        <div class="mb-2 form-control bg-{{ ($pengajuan->status_pengajuan <= 4 &&$pengajuan->status_pengajuan <= 24) ? 'success' : 'danger'}}">
          {{ $pengajuan->refStatusPengajuan->status_pengajuan_cuti }}
        </div>

        @if($pengajuan->status_pengajuan < 3 || $pengajuan->status_pengajuan === 22)
          <select class="form-control status" id="status_persetujuan" name="status_persetujuan">
            <option value="0">Perbarui Status Persetujuan</option>
            <option value="1">Disetujui</option>
            <option value="2">Ditolak</option>
          </select>
        @endif
      @endif

    @elseif($home['cmode'] == '14')
      @if($pengajuan->status_pengajuan < 4 || $pengajuan->status_pengajuan >= 4 && $pengajuan->status_pengajuan <= 24)
        <div class="mb-2 form-control bg-{{ ($pengajuan->status_pengajuan <= 4 &&$pengajuan->status_pengajuan <= 24) ? 'success' : 'danger'}}">
          {{ $pengajuan->refStatusPengajuan->status_pengajuan_cuti }}
        </div>

        @if($pengajuan->status_pengajuan < 4 || $pengajuan->status_pengajuan === 23)
          <select class="form-control status" id="status_persetujuan" name="status_persetujuan">
            <option value="0">Perbarui Status Persetujuan</option>
            <option value="1">Disetujui</option>
            <option value="2">Ditolak</option>
          </select>
        @endif
      @endif
    @endif
  </div>

  {{-- form alasan penolakan --}}
  <div class="w-100 alasan">
    <input type="hidden" name="nim"  value="{{ $pengajuan->nim }}">
    <input type="hidden" name="jenis_pengajuan"  value="{{ $pengajuan->jenis_pengajuan }}">

    @if(($home['cmode'] == '8' && ($pengajuan->status_pengajuan < 2 || $pengajuan->status_pengajuan === 21)) || ($home['cmode'] == '2' && ($pengajuan->status_pengajuan < 3 || $pengajuan->status_pengajuan === 22)) || ($home['cmode'] == '14' && ($pengajuan->status_pengajuan < 4 || $pengajuan->status_pengajuan === 23)))
      <textarea class="form-control alasan" id='alasan_{{ $pengajuan->id }}' rows="3" cols="50" name="alasan" placeholder="Beri alasan bila pengajuan ditolak" style="resize: none;" rows="5"></textarea>
    @endif
  </div>
  {{-- form alasan penolakan --}}

  <div class="modal-footer w-100">
    <button type="button" class="btn btn-danger text-white font-medium leading-tight rounded-sm shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0" data-bs-dismiss="modal">Batal</button>

    @if(($home['cmode'] == '8' && ($pengajuan->status_pengajuan < 2 || $pengajuan->status_pengajuan === 21)) || ($home['cmode'] == '2' && ($pengajuan->status_pengajuan < 3 || $pengajuan->status_pengajuan === 22)) || ($home['cmode'] == '14' && ($pengajuan->status_pengajuan < 4 || $pengajuan->status_pengajuan === 23))
    )
      <button type="submit" class="btn btn-primary text-white font-medium leading-tight rounded-sm shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0" data-toggle="tooltip" data-placement="top" title="Verifikasi Data" onclick="return confirm('Apakah Anda yakin dengan status terpilih ?')"
      >Proses</button>
    @else
      <button type="button" class="btn btn-primary text-white font-medium leading-tight rounded-sm shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0" data-toggle="tooltip" data-placement="top" title="Verifikasi Data" onclick="return confirm('Apakah Anda yakin dengan status terpilih ?')" disabled>Proses</button>
    @endif
  </div>
</div>

