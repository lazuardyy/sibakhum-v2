<aside class="main-sidebar bg-green-700 elevation-4">
  <a href="/home" class="brand-link">
    <img src="{{ asset('assets/img/unj.png') }}" alt="Unj-Logo" class="brand-image img-circle elevation-4" style="opacity: .8">
    <span class="brand-text text-white">{{ config('app.name', 'Sibakhum UNJ') }}</span>
  </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column gap-1" data-widget="treeview" role="menu">
        <li class="nav-item">
          <a href="/home" class="nav-link side-nav hover:bg-green-800 {{ isset($home_active) ? $home_active : '' }}">
            <i class="nav-icon fa-solid fa-house"></i>
            <p>Home</p>
          </a>
        </li>

        @if(session('user_cmode') == 1)

        @elseif(session('user_cmode') == 8 || session('user_cmode') == 2 || session('user_cmode') == 3 || session('user_cmode') == 14)

          @if(session('user_cmode') == 3 || session('user_cmode') == 14)
            <li class="nav-item">
              <a href="{{ route('data-pengajuan.index') }}" class="nav-link side-nav hover:bg-green-800 {{ isset($all_data_active) ? $all_data_active : '' }}">
                <i class="nav-icon fa-solid fa-database"></i>
                <p>Semua data pengajuan</p>
              </a>
            </li>
          @endif

          <li class="nav-item menu-open gap-1">
            <a href="#" class="nav-link text-white hover:bg-green-800">
              <i class="nav-icon fa-solid fa-square-plus"></i>
              <p>
                Data Pengajuan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('data-cuti.index') }}" class="nav-link text-white hover:bg-green-800 {{ isset($data_cuti_active) ? $data_cuti_active : '' }}" style="margin-bottom: 0.25rem">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cuti Kuliah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('data-md.index') }}" class="nav-link text-white hover:bg-green-800 {{ isset($data_md_active) ? $data_md_active : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengunduran Diri</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('history') }}" class="nav-link side-nav hover:bg-green-800 {{ isset($riwayat_active) ? $riwayat_active : '' }}">
              <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
              <p>Riwayat Persetujuan</p>
            </a>
          </li>

        @elseif(session('user_cmode') == 14)


        @elseif(session('user_cmode') == 9)
          <li class="nav-item menu-open gap-1">
            <a href="#" class="nav-link text-white hover:bg-green-800">
              <i class="nav-icon fa-solid fa-square-plus"></i>
              <p>
                Pengajuan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('pengajuan-cuti.create') }}" class="nav-link text-white hover:bg-green-800 {{ isset($cuti_active) ? $cuti_active : '' }}" style="margin-bottom: 0.25rem">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cuti Kuliah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pengunduran-diri.create') }}" class="nav-link text-white hover:bg-green-800 {{ isset($md_active) ? $md_active : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengunduran Diri</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open gap-1">
            <a href="#" class="nav-link text-white hover:bg-green-800">
              <i class="nav-icon fa-solid fa-square-plus"></i>
              <p>
                Status
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('pengajuan-cuti.show', base64_encode(session('user_username'))) }}" class="nav-link text-white hover:bg-green-800 {{ isset($status_cuti_active) ? $status_cuti_active : '' }}" style="margin-bottom: 0.25rem">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Status Cuti Kuliah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pengunduran-diri.show', base64_encode(session('user_username'))) }}" class="nav-link text-white hover:bg-green-800 {{ isset($status_md_active) ? $status_md_active : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Status Pengunduran Diri</p>
                </a>
              </li>
            </ul>
          </li>
        @else
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
