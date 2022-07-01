<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('assets/img/logo_unj2.png') }}">

  <title>{{ config('app.name', 'SiBakhum - UNJ') }} | {{ $title }} </title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link href="{{ asset('assets/font-awesome/css/all.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">

  <!-- Styles -->
  <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/index.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/pretty-checkbox/dist/pretty-checkbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin-lte/adminlte.min.css') }}" rel="stylesheet">
  @yield('style')
  {{-- <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/bootstrap/css/bootstrap.css') }}" rel="stylesheet"> --}}
</head>
<body class="sidebar-mini layout-fixed layout-navbar-fixed sidebar-closed sidebar-collapse">
  <main class="wrapper">
    @include('layouts.topbar')
    @include('layouts.sidebar')
    @include('flash-message')

    <section class="content-wrapper">
      @yield('content')
    </section>

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <strong>AdminLTE.io</a></strong>
        </div>
        <strong>Copyright &copy; 2022 <a href="https://pustikom.unj.ac.id/">UPT.TIK-UNJ</a>.</strong> <b>Version</b> 1.0.0
    </footer>
  </div>

  {{-- <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
  <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script> --}}
  {{-- <script>
    const chart = new Chartisan({
      el: '#chart',
      url: "@chart('FakultasChart')",
      loader: {
        color: '#ff00ff',
        size: [30, 30],
        type: 'bar',
        textColor: '#000',
        text: 'Loading fakultas chart data...',
      },
      hooks: new ChartisanHooks()
        .tooltip(),
    });
  </script> --}}
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/adminlte.min.js') }}"></script>
  <script src="{{ asset('js/script.js') }}"></script>
  @yield('script')
</body>
</html>
