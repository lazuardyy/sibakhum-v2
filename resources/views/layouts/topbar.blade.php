<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  @if ($cmode != '9' && $cmode != '3' && $cmode !== '14' && $cmode != '20')
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <i class="fa-solid fa-user"></i>
            <span class="d-none d-md-inline">{{ session('user_name') }}</span>
          </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="notifications" aria-expanded="false" data-bs-toggle="dropdown">
          <i class="fa-solid fa-bell"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger text-xs {{ ($count_cuti + $count_md !== 0) ? '' : 'd-none' }}" id="number">
            {{ $count_cuti + $count_md }}
          </span>
        </a>

        <div class="dropdown-menu" aria-labelledby="notifications">
          @if($count_cuti + $count_md !== 0)
            <div class="toast-header">
              <small>New message!</small>
            </div>
            <div class="toast-header">
              <span>Halo {{ $user }}, kamu memiliki {{ $count_cuti + $count_md }} data pengajuan baru. Cek sekarang!</span>
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
