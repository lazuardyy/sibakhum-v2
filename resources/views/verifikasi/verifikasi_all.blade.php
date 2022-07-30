<div class="card">
  <div class="card-header">
    <div class="card-title">
      <label for="disetujui" type="button" data-bs-toggle="modal" data-bs-target="#setujuModal" class="btn btn-outline-success" style="margin-bottom: 0" id="setuju-button">
        <i class="fa-solid fa-paper-plane mr-1"></i>
        {{ ($home['cmode'] != config('constants.users.fakultas')) ? 'Disetujui' : 'Proses' }}
      </label>
      <input type="checkbox" id="disetujui" class="d-none">

      @if($home['cmode'] != config('constants.users.fakultas'))
        <label for="ditolak" type="button" data-bs-toggle="modal" data-bs-target="#tolakModal" class="btn btn-outline-danger" style="margin-bottom: 0" id="tolak-button">
          <i class="fa-solid fa-paper-plane mr-1"></i>
          Ditolak
        </label>
        <input type="checkbox" id="ditolak" class="d-none">
      @endif
    </div>

    <div class="card-tools">
      <form action="{{ route('data-mhs.verifikasi') }}" method="GET" id="filter">
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
    <form action="{{ route('data-mhs.verifikasi') }}" method="post" id="form-data">
    @csrf

      <div class="modal fade" id="setujuModal" tabindex="-1" aria-labelledby="submitModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header" style="justify-content: start; align-items:center; gap:.5rem;">
              <div class="bg-warning d-flex align-items-center gap-1 pl-2 pr-2 rounded-md">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <h5 class="modal-title" id="submitModal">Submit Persetujuan</h5>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <h6 id="keterangan">Apakah anda yakin dengan status persetujuan yang dipilih?</h6>
            </div>
            <div class="modal-footer">
              <x-button.button-submit buttonName="Batal" buttonColor="red" buttonIcon="fa-solid fa-ban" type="button" data-bs-dismiss="modal"/>
              <x-button.button-submit buttonName="Proses" buttonColor="green" buttonIcon="fa-solid fa-paper-plane" type="button" data-bs-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Verifikasi Data" onclick="document.getElementById('form-data').submit()"/>
            </div>
          </div>
        </div>
      </div>

      <table class="table compact" id="table-all-data">
        <thead>
          <tr>
            <th id="pilih">
              <label for="selectAll" class="mr-1 disetujui user-select-none cursor-pointer" style="margin-bottom: 0" id="1">
                Pilih
              </label>
              <input type="checkbox" id="selectAll" value="select" class="cursor-pointer">
            </th>
            <th>Details</th>
            <th>No.</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Program Studi</th>
            <th>Tanggal Pengajuan</th>
            <th>Jenis Pengajuan</th>
            <th>No. Surat</th>
            <th>Surat Pengajuan</th>

          </tr>
        </thead>
        <tbody>
          @forelse($verifikasi['pengajuan_mhs'] as $index => $pengajuan)
            @if(isset($pengajuan->nim))
              <tr>
                <td class="text-center">
                  <input type="hidden" name="jenis_pengajuan[]" value="{{ ($pengajuan->jenis_pengajuan === 1) ? 1 : 2 }}" id="checklist_{{ $pengajuan->id }}">
                  <input type="hidden" name="persetujuan[]" value="1">

                  @if(($home['cmode'] == config('constants.users.dekanat') && ($pengajuan->status_pengajuan != 5 && $pengajuan->status_pengajuan <= 24)))
                    <input type="checkbox" name="id_pengajuan[]" value="{{ $pengajuan->id }}" id="checklist_{{ $pengajuan->id }}" @checked(old('active', ($pengajuan->status_pengajuan == 4 ? true : false)))>

                    <label for="checklist_{{ $pengajuan->id }}" class="text-sm user-select-none">
                      <span class="text-{{ ($pengajuan->status_pengajuan <= 7) ? 'success' : 'danger' }}">{{ ($pengajuan->status_pengajuan <= 7) ? ''  : 'Ditolak' }}</span>
                    </label>
                  @elseif(($home['cmode'] == config('constants.users.wakil_rektor') && ($pengajuan->status_pengajuan != 6 && $pengajuan->status_pengajuan <= 24)))
                    <input type="checkbox" name="id_pengajuan[]" value="{{ $pengajuan->id }}" id="checklist_{{ $pengajuan->id }}" @checked(old('active', ($pengajuan->status_pengajuan == 5 ? true : false)))>

                    <label for="checklist_{{ $pengajuan->id }}" class="text-sm user-select-none">
                      <span class="text-{{ ($pengajuan->status_pengajuan <= 7) ? 'success' : 'danger' }}">{{ ($pengajuan->status_pengajuan <= 7) ? ''  : 'Ditolak' }}</span>
                    </label>

                  @elseif(($home['cmode'] == config('constants.users.fakultas') && ($pengajuan->status_pengajuan != 6 && $pengajuan->status_pengajuan <= 24)))
                    <input type="checkbox" name="id_pengajuan[]" value="{{ $pengajuan->id }}" id="checklist_{{ $pengajuan->id }}" @checked(old('active', ($pengajuan->status_pengajuan == 3 ? true : false)))>

                    <label for="checklist_{{ $pengajuan->id }}" class="text-sm user-select-none">
                      <span class="text-{{ ($pengajuan->status_pengajuan !== 5) ? 'warning' : 'success' }}">{{ ($pengajuan->status_pengajuan == 5) ? 'Selesai diproses' : 'Menunggu diproses' }}</span>
                    </label>
                  @endif
                </td>

                <td class="text-center">
                  <a href="{{ route('data-mhs.detailMhs', base64_encode(base64_encode($pengajuan->id))) }}" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-eye-slash" id="button_{{ $pengajuan->id }}"></i>
                  </a>
                </td>

                <td>{{ $loop->iteration }}</td>

                <input type="hidden" name="id[]" value="{{ $pengajuan->id }}">
                {{-- <input type="hidden" name="jenis_pengajuan[]" value="{{ $pengajuan->jenis_pengajuan }}"> --}}
                <td>{{ $pengajuan->nim }}</td>
                <td>{{ $pengajuan->nama }}</td>

                <td>{{ $pengajuan->nama_prodi }}</td>
                <td>{{ $pengajuan->created_at->format('d M Y') }} <br> Pukul {{ $pengajuan->created_at->format('H:i') }} WIB</td>
                <td>{{ ($pengajuan->jenis_pengajuan === 1) ? 'Cuti' : 'Pengunduran Diri' }}</td>

                <td>
                  @if($home['cmode'] == config('constants.users.fakultas'))
                    <input type="text" name="no_surat_fakultas[]" id="no_surat_{{ $pengajuan->id }}" placeholder="masukkan no surat..." class="form-control" value={{ ($pengajuan->refSurat->no_surat_fakultas !== null) ? $pengajuan->refSurat->no_surat_fakultas : '' }} {{ ($home['cmode'] !== config('constants.users.fakultas') ? 'readonly' : '') }}>

                  @else
                    <span class="btn w-full border-gray-300 cursor-text text-left">{{ $pengajuan->refSurat->no_surat_fakultas }}</span>
                  @endif
                </td>

                <td class="text-center">
                  @if($pengajuan->jenis_pengajuan === 2)
                    <x-button.button-href buttonName="lihat surat" buttonIcon="fa-solid fa-file-pdf" btnColor="indigo" href="{{ route('file_pengajuan.show', $pengajuan->refFilePengajuan->file_pengajuan) }}" target="_blank" data-bs-toggle="tooltip" title="File Pengajuan {{ $pengajuan->jenis_pengajuan == '2' ? 'Pengunduran Diri' : '' }} {{ $pengajuan->nama }}" class="btn-sm"/>
                  @else
                    <span>N/A</span>
                  @endif
                </td>
              </tr>
            @endif
          @empty
            <tr>
              <td colspan="10" class="text-center">No data avalaible.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </form>
  </div>
</div>
