<div>
  <div class="mb-1">
    <label for="status_pengajuan">Pilih Status Persetujuan</label>
      @if($home['cmode'] == '8')
        <select class="form-control col status" id="status_persetujuan_{{ $pengajuan->nim }}" name="status_persetujuan" {{ ($pengajuan->status_pengajuan !== 1) ? '' : 'disabled' }}>
          <option value="0">Pilih Status Persetujuan</option>
          <option value="1">Disetujui</option>
          <option value="2">Ditolak</option>
        </select>
      @elseif($home['cmode'] == '2')
        <select class="form-control col status" id="status_persetujuan_{{ $pengajuan->nim }}" name="status_persetujuan" {{ ($pengajuan->status_pengajuan !== 2) ? '' : 'disabled' }}>
          <option value="0">Pilih Status Persetujuan</option>
          <option value="1">Disetujui</option>
          <option value="2">Ditolak</option>
          <option value="3">Diproses</option>
        </select>
      @endif
  </div>

  <div class="row form-group" style="margin-bottom: 0">
    <div class="col w-100 alasan" id="alasan" style="display: none">
      <input type="hidden" name="nim"  value="{{ $pengajuan->nim }}">
      <input type="hidden" name="jenis_pengajuan"  value="{{ $pengajuan->jenis_pengajuan }}">

      <textarea class="form-control col" rows="3" cols="50" name="alasan" placeholder="Beri alasan bila pengajuan ditolak" style="resize: none" rows="5"></textarea>
    </div>
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-danger text-white font-medium leading-tight rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0" data-bs-dismiss="modal">Batal</button>

    <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Verifikasi Data" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin dengan status terpilih ?')"><i class="fas fa-arrow"></i> Proses</button>
  </div>
</div>
