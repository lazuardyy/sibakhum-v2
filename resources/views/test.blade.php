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
          <a href="{{ url('test') }}" class="link__item {{ ($title === 'Mahasiswa') ? 'active' : '' }} block p-1 w-9 h-9 lg:w-full rounded shadow-md hover:bg-green-800">
            <i class="fa-solid fa-house"></i>
            <span class="hidden lg:block">Home</span>
          </a>
        </ul>

        <ul class="flex flex-col justify-end">
          <div class="w-full">
            <form id="logout-form" action="/logout" method="POST">
              @csrf
              <button type="submit" class="block p-1 w-9 h-9 lg:w-full text-center bg-red-600 hover:bg-red-700 text-violet-50 rounded leading-7">
                <i class="fa-solid fa-power-off"></i>
                <span class="invisible lg:visible leading-7">
                  {{ __('Logout') }}
                </span>
              </button>
            </form>
          </div>
        </ul>
      </div>
    </nav>

    <nav>
      <div class="pl-2 pr-2 pt-2 pb-2 flex bg-cyan-600 fixed top-0 left-0 right-0">
        <h2 class="invisible text-l flex-1">
        </h2>
        <h2 class="block text-sm lg:text-l tracking-wider text-violet-50 font-medium p-2 lg:p-2 rounded shadow-md bg-cyan-500">
          Dashboard
        </h2>
      </div>
    </nav>

    <main class="grid ml-12 lg:ml-48 mt-12">
        <div class="w-full pl-2 lg:pl-0 pr-2 pt-3">
          <div class="alert bg-blue-100 rounded-lg p-2 text-base text-blue-700 flex items-center w-full alert-dismissible fade show shadow-md justify-end" role="alert">
            <span>Selamat Datang</span>
              <strong class="mr-1">
              </strong>
            <span>di {{ config('app.name', '') }}!</span>
            <button type="button" class="btn-close box-content w-4 h-4 p-1 ml-auto text-blue-800 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-blue-900 hover:opacity-75 hover:no-underline" data-bs-dismiss="alert" aria-label="Close">
              <i class="fa-solid fa-xmark"></i>
            </button>
          </div>
          <div class="grid grid-rows-2 gap-4 p-4 place-content-center justify-items-center lg:pt-7 pt-14 text-center">
            <div class="grid lg:grid-cols-2 md:grid-cols-2 gap-4">
              <a href="{{ route('cuti.create') }}" class="flex flex-col justify-center gap-2 px-12 lg:px-14 py-16 bg-green-600 text-white font-medium text-xs lg:text-lg leading-tight uppercase rounded-lg shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
                <i class="fa-solid fa-angles-left"></i>
                <span class="text-xs lg:text-base">Ajukan Cuti</span>
              </a>
              <a href="{{ route('md.create') }}" class="flex flex-col justify-center gap-2 px-12 lg:px-14 py-16 bg-blue-600 text-white font-medium text-xs lg:text-lg leading-tight uppercase rounded-lg shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                <i class="fa-solid fa-angles-right"></i>
                <span class="text-xs lg:text-base">Ajukan Pengunduran Diri</span>
              </a>
              <a href="{{ url('mahasiswa/status-pengajuan') }}" class="flex flex-col gap-2 px-12 lg:px-14 py-16 bg-yellow-500 text-white font-medium text-xs lg:text-lg leading-tight uppercase rounded-lg shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-800 active:shadow-lg transition duration-150 ease-in-out">
                <i class="fa-solid fa-handshake text-2xl"></i>
                <span class="text-xs lg:text-base">Status Pengajuan Cuti</span>
              </a>
              <a href="{{ url('mahasiswa/status-pengajuan') }}" class="flex flex-col gap-2 px-12 lg:px-14 py-16 bg-yellow-500 text-white font-medium text-xs lg:text-lg leading-tight uppercase rounded-lg shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-800 active:shadow-lg transition duration-150 ease-in-out">
                <i class="fa-solid fa-handshake text-2xl"></i>
                <span class="text-xs lg:text-base">Status Pengunduran Diri</span>
              </a>
            </div>
        </div>
    </main>
  </div>

  <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
  <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
</body>
</html>
