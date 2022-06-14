<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  @if ($home['cmode'] != '9' && $home['cmode'] != '3' && $home['cmode'] !== '14' && $home['cmode'] != '20')
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
          @if($home['pengajuan']['cuti'] + $home['pengajuan']['md'] !== 0)
            <div class="toast-header">
              <small>New message!</small>
            </div>
            <div class="toast-header">
              <span>Halo {{ $home['user'] }}, kamu memiliki {{ $home['pengajuan']['cuti'] + $home['pengajuan']['md'] }} data pengajuan baru. Cek sekarang!</span>
            </div>
          @else
            <div class="toast-header">
              <small>No data avalaible.</small>
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
