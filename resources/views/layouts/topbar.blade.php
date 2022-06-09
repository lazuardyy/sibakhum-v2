<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
          <a href="/alur" class="nav-link">Alur Dispensasi UKT</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
          <a href="/sk_dispensasi" class="nav-link">SK Dispensasi UKT</a>
      </li> --}}
  </ul>
  <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <i class="fa-solid fa-user"></i>
            <span class="d-none d-md-inline">{{ session('user_name') }}</span>
          </a>
      </li>
  </ul>

</nav>
