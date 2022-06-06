<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('assets/img/logo_unj2.png') }}">

  <title>{{ config('app.name', 'SiBakhum - UNJ') }} | {{ $title }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link href="{{ asset('assets/font-awesome/css/all.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">

  <!-- Styles -->
  <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/index.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/pretty-checkbox/dist/pretty-checkbox.min.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app" class="relative">
    <nav class="fixed top-0 bottom-0 bg-green-700 drop-shadow-2xl rounded-r-2xl z-10">
      <div class="relative grid h-full container pl-1 pb-5 pt-2 lg:p-3 gap-2 w-12 lg:w-full">
        <div class="lg:flex lg:flex-col lg:justify-start lg:items-center lg:gap-x-3">
            <img src="{{ asset('assets/img/unj.png') }}" alt="logo" class="w-9 lg:w-11 drop-shadow-l">
            <h2 class="hidden lg:block lg:text-2xl lg:text-violet-50 lg:text-center">
                {{ config('app.name', 'Sibakhum UNJ') }}
            </h2>
        </div>

        <ul class="h-full flex flex-col gap-2 text-violet-50 lg:w-40" id="menu">
            @include('partials.menu')
        </ul>

        <ul class="flex flex-col justify-end">
            @include('partials.auth')
        </ul>
      </div>
    </nav>

    {{-- @auth --}}
    <nav>
      <div class="pl-2 pr-2 pt-2 pb-2 flex bg-cyan-600 fixed top-0 left-0 right-0">
        <h2 class="invisible text-l flex-1">
          {{-- Dasboard {{ Auth::user() -> role }} --}}
        </h2>
        <h2 class="block text-sm lg:text-l tracking-wider text-violet-50 font-medium p-2 lg:p-2 rounded shadow-md bg-cyan-500">
          {{-- Dashboard <span class="uppercase">{{ Auth::user() -> role }}</span> --}} Dashboard
        </h2>
      </div>
    </nav>
    {{-- @endauth --}}

    <main class="grid ml-12 lg:ml-48 mt-12">
        <div class="w-full pl-2 lg:pl-0 pr-2 pt-3">
        @yield('content')
        </div>
    </main>
  </div>

  <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
  <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
  <script>
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
  </script>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
