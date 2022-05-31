@extends('layouts.main')

@section('content')
  <div class="container grid p-4 gap-4">
    <div class="section__header">
      <h1 class="font-medium leading-tight text-2xl lg:text-4xl mt-0 mb-2 text-center">Data Grafik {{ $title }}</h1>
    </div>

    <div class="grid grid-cols-2">
      <div class="col-1">
        <div class="chart__title">
          <h1 class="font-medium leading-tight text-xl lg:text-2xl mt-0 mb-2 text-center">Pengajuan Cuti</h1>
        </div>

        <!-- Chart's container -->
        <div id="chart" style="height: 300px;"></div>
        <!-- Charting library -->

      </div>
      <div class="col-2">
        <h1>chart 2</h1>
      </div>
    </div>
  </div>
@endsection
