<div class="card">
  <div class="card-header">
    <div class="card-title">
      <label for="disetujui" type="button" data-bs-toggle="modal" data-bs-target="#setujuModal" class="btn btn-outline-success mr-1" style="margin-bottom: 0" id="setuju-button">
        <i class="fa-solid fa-paper-plane mr-1"></i>
        Simpan
      </label>
      <input type="checkbox" id="disetujui" class="d-none">
    </div>

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
            <x-button.button-submit type="button" data-bs-dismiss="modal" buttonName="Batal" buttonIcon="fa-solid fa-ban" buttonColor="red"/>

            <x-button.button-submit type="button" buttonName="Proses" buttonIcon="fa-solid fa-paper-plane mr-1" buttonColor="green" data-toggle="tooltip" data-placement="top" title="Verifikasi Data" onclick="document.getElementById('form-data').submit()"/>
          </div>
        </div>
      </div>
    </div>

    <div class="card-tools">
      <form action="{{ route('data-mhs.index') }}" method="GET" id="filter">
        <select class="form-select btn border-1 border-sky-500 text-left" name="jenis_pengajuan">
          <option selected>Filter Data...</option>
          <option value="semua">Semua</option>
          <option value="cuti">Cuti</option>
          <option value="pengunduran_diri">Pengunduran Diri</option>
        </select>

        <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('filter').submit()"data-toggle="tooltip" title="Search"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
    </div>
  </div>

  <div class="card-body p-3 overflow-x-scroll">
    <form action="{{ route('data-mhs.verifikasi-bakhum') }}" method="post" id="form-data">
    @csrf
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
            <th>Program Studi</th>
            <th>Jenis Pengajuan</th>
            <th>No. Surat Fakultas</th>
            <th>No. Surat Bakhum</th>
            <th>Status Pembayaran</th>
            <th>Surat Pengajuan</th>
            {{-- @if($status_pembayaran != '0') --}}
            <th>Cetak Surat</th>
            {{-- @endif --}}
          </tr>
        </thead>
        <tbody>
          @foreach($verifikasi['pengajuan_mhs'] as $index => $pengajuan)
            @if($pengajuan->file_sk === null)
              <tr>
                @if(($pengajuan->jenis_pengajuan === 2 && $pengajuan->no_surat_bakhum === null) || ($pengajuan->jenis_pengajuan == 1 && $pengajuan->status_pembayaran == 1 && $pengajuan->no_surat_bakhum === null))
                  <td class="text-center">
                    <input type="checkbox" name="id_pengajuan[]" value="{{ $pengajuan->id }}" id="checklist_{{ $pengajuan->id }}" @checked(old('active', ($pengajuan->status_pengajuan == 6) ? true : false))>

                    <input type="hidden" name="jenis_pengajuan[]" value="{{ ($pengajuan->jenis_pengajuan === 1) ? 1 : 2 }}" id="checklist_{{ $pengajuan->id }}">
                    <input type="hidden" name="persetujuan[]" value="1">

                    <label for="checklist_{{ $pengajuan->id }}" class="text-sm user-select-none">
                      <span class="text-{{ ($pengajuan->refSurat->no_surat_bakhum !== null) ? 'success' : 'warning' }}">{{ ($pengajuan->refSurat->no_surat_bakhum !== null) ? 'Data tersimpan' : 'Menunggu diproses' }}</span>
                    </label>
                  </td>
                @else
                  <td class="text-center"><span class="cursor-pointer" data-bs-toggle="tooltip" title="Nomor surat dapat disimpan apabila mahasiswa telah melakukan pembayaran"><i class="fa-solid fa-circle-question text-md text-info"></i></span></td>
                @endif

                <td>{{ $loop->iteration }}</td>
                <td>{{ $pengajuan->nim }}</td>
                <td>{{ $pengajuan->nama }}</td>
                <td>{{ $pengajuan->nama_prodi }}</td>
                <td>{{ $pengajuan->jenis_pengajuan === 1 ? 'Cuti' : 'Pengunduran Diri' }}</td>

                <td><span>{{ $pengajuan->refSurat->no_surat_fakultas }}</span></td>

                @if(($pengajuan->jenis_pengajuan === 2 && $pengajuan->no_surat_bakhum === null) || ($pengajuan->jenis_pengajuan == 1 && $pengajuan->status_pembayaran == 1 && $pengajuan->no_surat_bakhum === null))
                  <td>
                    <input type="text" name="no_surat_bakhum[]" id="no_surat_{{ $pengajuan->id }}" placeholder="Masukkan no surat..." class="form-control" value={{ ($pengajuan->no_surat_bakhum !== null) ? $pengajuan->no_surat_bakhum : '' }}>
                  </td>
                @elseif($pengajuan->no_surat_bakhum !== null)
                  <td>
                    <span class="btn w-full border-gray-300 cursor-text text-left">{{ $pengajuan->no_surat_bakhum }}</span>
                  </td>
                @else
                  <td><span class="btn w-full border-gray-300 cursor-text">N/A</span></td>
                @endif

                <td class="text-center">
                  @if($pengajuan->jenis_pengajuan === 1)
                    <span class="btn {{ ($pengajuan->status_pembayaran == 0) ? 'bg-warning' : 'bg-success' }} w-full cursor-default">{{ ($pengajuan->status_pembayaran == 0) ? 'Belum Bayar' : 'Sudah Bayar' }}</span>
                  @else
                    <span class="btn w-full bg-gray-200 border-gray-300 cursor-default">N/A</span>
                  @endif
                </td>

                <td class="text-center">
                  @if($pengajuan->jenis_pengajuan === 2)
                    <x-button.button-href buttonName="Lihat File" buttonIcon="fa-solid fa-file-pdf" btnColor="violet" href="{{ route('file_pengajuan.show', $pengajuan->refFilePengajuan->file_pengajuan_md) }}" class="btn-sm" target="_blank"/>
                  @else
                    <span class="cursor-pointer" data-bs-toggle="tooltip" title="Tidak terdapat file pengajuan"><i class="fa-solid fa-circle-minus text-danger"></i></span>
                  @endif
                </td>

                <td class="text-center">
                  @if( ($pengajuan->jenis_pengajuan == 1 && $pengajuan->status_pembayaran != 0 && $pengajuan->no_surat_bakhum !== null) || ($pengajuan->jenis_pengajuan == 2 && $pengajuan->no_surat_bakhum !== null))
                    <x-button.button-href buttonName="" buttonIcon="fa-solid fa-print" btnColor="blue" href="{{ route('data-mhs.cetak', $pengajuan->id) }}" class="btn-sm"/>
                  @else
                    <span class="cursor-pointer" data-bs-toggle="tooltip" title="Surat dapat dicetak apabila nomor surat telah disimpan"><i class="fa-solid fa-circle-question text-md text-info"></i></span>
                  @endif
                </td>
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
  </form>
  </div>
</div>
