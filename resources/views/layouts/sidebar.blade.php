<aside class="main-sidebar bg-green-700 elevation-4">
  <a href="/home" class="brand-link">
    <img src="{{ asset('assets/img/unj.png') }}" alt="Unj-Logo" class="brand-image img-circle elevation-4" style="opacity: .8">
    <span class="brand-text text-white">{{ config('app.name', 'Sibakhum UNJ') }}</span>
  </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column gap-1" data-widget="treeview" role="menu">
        <li class="nav-item">
          <a href="/home" class="nav-link side-nav hover:bg-green-800 {{ isset($home_active) ? $home_active : '' }}" accesskey="h">
            <i class="nav-icon fa-solid fa-house"></i>
            <p>Home</p>
          </a>
        </li>

        @if(session('user_cmode') == 1)

        @elseif(session('user_cmode') != config('constants.users.mahasiswa'))
          @if(session('user_cmode') == config('constants.users.bakhum'))
            <li class="nav-item">
              <a href="{{ route('periode.index') }}" class="nav-link side-nav hover:bg-green-800 {{ isset($buka_periode_active) ? $buka_periode_active : '' }}">
                <i class="nav-icon fa-solid fa-unlock"></i>
                <p>Buka Periode</p>
              </a>
            </li>

            {{-- <li class="nav-item">
              <a href="{{ route('data-mhs.ubah-tagihan')}}" class="nav-link text-white hover:bg-green-800 {{ isset($tagihan_data_active) ? $tagihan_data_active : '' }}" style="margin-bottom: 0.25rem">
                <i class="nav-icon fa-solid fa-square-pen"></i>
                <p>Ubah Status Tagihan</p>
              </a>
            </li> --}}
            {{-- <li class="nav-item">
              <a href="{{ route('data-mhs.index') }}" class="nav-link text-white hover:bg-green-800 {{ isset($semua_data_active) ? $semua_data_active : '' }}" style="margin-bottom: 0.25rem">
                <i class="nav-icon fa-solid fa-database"></i>
                <p>Semua data pengajuan</p>
              </a>
            </li> --}}
            <li class="nav-item">
              <a href="{{ route('data-mhs.upload-sk') }}" class="nav-link text-white hover:bg-green-800 {{ isset($kirim_data_active) ? $kirim_data_active : '' }}" style="margin-bottom: 0.25rem">
                <i class="nav-icon fa-solid fa-upload"></i>
                <p>Kirim Surat Keterangan</p>
              </a>
            </li>
          @endif

          @if($home['cmode'] != config('constants.users.dosen') && $home['cmode'] != config('constants.users.mahasiswa') && $home['cmode'] != config('constants.users.prodi'))
            <li class="nav-item">
              <a href="{{ route('data-mhs.index') }}" class="nav-link side-nav hover:bg-green-800 {{ isset($all_data_active) ? $all_data_active : '' }}">
                <i class="nav-icon fa-solid fa-database"></i>
                <p>Semua data pengajuan</p>
              </a>
            </li>
          @endif

          @if($home['cmode'] == config('constants.users.prodi'))
            <li class="nav-item">
              <a href="{{ route('pengajuan-mhs.create-md') }}" class="nav-link side-nav hover:bg-green-800 {{ isset($md_active) ? $md_active : '' }}">
                <i class="nav-icon fa-solid fa-circle-plus"></i>
                <p>Pengunduran Diri</p>
              </a>
            </li>
          @endif

          @if(session('user_cmode') == config('constants.users.fakultas'))
            <li class="nav-item">
              <a href="{{ route('surat-masuk') }}" class="nav-link side-nav hover:bg-green-800 {{ isset($surat_active) ? $surat_active : '' }}">
                <i class="nav-icon fa-solid fa-envelope"></i>
                <p>Surat Masuk</p>
              </a>
            </li>
          @endif

          @if(session('user_cmode') == config('constants.users.dosen') || session('user_cmode') == config('constants.users.prodi') || session('user_cmode') == config('constants.users.dekanat') || session('user_cmode') == config('constants.users.wakil_rektor'))
            <li class="nav-item menu-open gap-1">
              <a href="#" class="nav-link text-white hover:bg-green-800">
                <i class="nav-icon fa-solid fa-info"></i>
                <p>
                  Data Pengajuan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('data-mhs.show', 'cuti') }}" class="nav-link text-white hover:bg-green-800 {{ isset($data_cuti_active) ? $data_cuti_active : '' }}" style="margin-bottom: 0.25rem">
                    <i class="fa-solid fa-person-walking nav-icon"></i>
                    <p>Cuti Kuliah</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('data-mhs.show', 'md') }}" class="nav-link text-white hover:bg-green-800 {{ isset($data_md_active) ? $data_md_active : '' }}" style="margin-bottom: 0.25rem">
                    <i class="fa-solid fa-plane-up nav-icon"></i>
                    <p>Pengunduran Diri</p>
                  </a>
                </li>
              </ul>
            </li>
          @endif

          @if($home['cmode'] != config('constants.users.dosen') && $home['cmode'] && config('constants.users.mahasiswa') && $home['cmode'] != config('constants.users.prodi'))

            <li class="nav-item">
              <a href="{{ route('grafik') }}" class="nav-link side-nav hover:bg-green-800 {{ isset($grafik_active) ? $grafik_active : '' }}">
                <i class="nav-icon fa-solid fa-chart-simple"></i>
                <p>Data & Grafik</p>
              </a>
            </li>
          @endif

          <li class="nav-item">
            <a href="{{ route('history') }}" class="nav-link side-nav hover:bg-green-800 {{ isset($riwayat_active) ? $riwayat_active : '' }}">
              <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
              <p>Riwayat Persetujuan</p>
            </a>
          </li>

        @elseif(session('user_cmode') == config('constants.users.mahasiswa'))
          <li class="nav-item">
            <a href="{{ route('pengajuan-mhs.create') }}" class="nav-link text-white hover:bg-green-800 {{ isset($cuti_active) ? $cuti_active : '' }}" style="margin-bottom: 0.25rem" accesskey='c'>
              <i class="nav-icon fa-solid fa-square-plus"></i>
              <p>Pengajuan Cuti Kuliah</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('pengajuan-mhs.show', base64_encode(session('user_username'))) }}" class="nav-link text-white hover:bg-green-800 {{ isset($status_cuti_active) ? $status_cuti_active : '' }}" style="margin-bottom: 0.25rem">
              <i class="nav-icon fa-solid fa-list-check"></i>
              <p>Status Cuti Kuliah</p>
            </a>
          </li>
        @endif

        <li class="nav-item">
          <a href="/logout" class="nav-link side-nav" id="logout">
            <i class="nav-icon fa-solid fa-power-off"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
