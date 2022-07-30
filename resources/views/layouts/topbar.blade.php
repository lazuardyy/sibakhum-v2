<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  @if ($home['cmode'] !== config('constants.users.mahasiswa'))
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <i class="fa-solid fa-user"></i>
            <span class="d-none d-md-inline">{{ $home['user'] }}</span>
          </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="notifications" aria-expanded="false" data-bs-toggle="dropdown">
          <i class="fa-solid fa-bell"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger text-xs {{ ($home['pengajuan']['cuti'] + $home['pengajuan']['md'] !== 0) ? '' : 'd-none' }}" id="number">
            {{ $home['pengajuan']['cuti'] + $home['pengajuan']['md'] }}
          </span>
        </a>

        <div class="dropdown-menu" aria-labelledby="notifications">
          {{-- @if($home['pengajuan']['cuti'] + $home['pengajuan']['md'] !== 0) --}}

            @if($home['pengajuan']['cuti'] !== 0 && $home['pengajuan']['md'] !== 0)
              <div class="toast-header">
                <i class="nav-icon fa-solid fa-envelope text-sm mr-1 text-green-600"></i>
                <small class="text-bold text-green-600">New message!</small>
              </div>
              <div class="toast-header d-flex flex-column">
                  <div class="row border-bottom mb-3 p-2">
                    <span class="mb-2 text-sm">Halo {{ $home['user'] }}, kamu memiliki <strong>{{ $home['pengajuan']['cuti'] }}</strong> data pengajuan <strong>CUTI</strong> baru.</span>
                    @if($home['cmode'] == config('constants.users.fakultas') || $home['cmode'] == config('constants.users.bakhum'))
                      <a href="{{ route('data-mhs.index') }}" class="btn btn-primary btn-sm w-100">Cek disini!</a>
                    @else
                      <a href="{{ route('data-mhs.show', 'cuti') }}" class="btn btn-primary btn-sm w-100">Cek disini!</a>
                    @endif
                  </div>

                  <div class="row border-bottom mb-3 p-2">
                    <span class="mb-2 text-sm">Halo {{ $home['user'] }}, kamu memiliki <strong>{{ $home['pengajuan']['md'] }}</strong> data pengajuan <strong>PENGUNDURAN DIRI</strong> baru.</span>
                    @if($home['cmode'] == config('constants.users.fakultas') || $home['cmode'] == config('constants.users.bakhum'))
                      <a href="{{ route('data-mhs.index') }}" class="btn btn-primary btn-sm w-100">Cek disini!</a>
                    @else
                      <a href="{{ route('data-mhs.show', 'md') }}" class="btn btn-primary btn-sm w-100">Cek disini!</a>
                    @endif
                  </div>
              </div>
            @elseif($home['pengajuan']['cuti'] !== 0 && $home['pengajuan']['md'] === 0)
              <div class="toast-header">
                <i class="nav-icon fa-solid fa-envelope text-sm mr-1 text-green-600"></i>
                <small class="text-bold text-green-600">New message!</small>
              </div>
              <div class="toast-header d-flex flex-column">
                <div class="row border-bottom mb-3 p-2">
                  <span class="mb-2 text-sm">Halo {{ $home['user'] }}, kamu memiliki <strong>{{ $home['pengajuan']['cuti'] }}</strong> data pengajuan <strong>CUTI</strong> baru.</span>
                    @if($home['cmode'] == config('constants.users.fakultas') || $home['cmode'] == config('constants.users.bakhum'))
                      <a href="{{ route('data-mhs.index') }}" class="btn btn-primary btn-sm w-100">Cek disini!</a>
                    @else
                      <a href="{{ route('data-mhs.show', 'cuti') }}" class="btn btn-primary btn-sm w-100">Cek disini!</a>
                    @endif
                </div>
              </div>
            @elseif($home['pengajuan']['cuti'] === 0 && $home['pengajuan']['md'] !== 0)
              <div class="toast-header">
                <i class="nav-icon fa-solid fa-envelope text-sm mr-1 text-green-600"></i>
                <small class="text-bold text-green-600">New message!</small>
              </div>
              <div class="toast-header d-flex flex-column">
                <div class="row border-bottom mb-3 p-2">
                  <span class="mb-2 text-sm">Halo {{ $home['user'] }}, kamu memiliki <strong>{{ $home['pengajuan']['md'] }}</strong> data pengajuan <strong>PENGUNDURAN DIRI</strong> baru.</span>
                  @if($home['cmode'] == config('constants.users.fakultas') || $home['cmode'] == config('constants.users.bakhum'))
                    <a href="{{ route('data-mhs.index') }}" class="btn btn-primary btn-sm w-100">Cek disini!</a>
                  @else
                    <a href="{{ route('data-mhs.show', 'md') }}" class="btn btn-primary btn-sm w-100">Cek disini!</a>
                  @endif
                </div>
              </div>
            @else
              <div class="toast-header">
                <small>Tidak ada data pengajuan baru.</small>
              </div>
            @endif
        </div>
      </li>
    </ul>

    @else
      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <i class="fa-solid fa-user"></i>
            <span class="d-none d-md-inline">{{ session('user_name') }}</span>
          </a>
        </li>
      </ul>
  @endif
</nav>

@section('script')
  <script>
    $(document).ready(function() {
      $('#notifications').click(function() {
        $('#number').hide();
      });
    });
  </script>
@endsection
