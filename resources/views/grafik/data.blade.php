@extends('layouts.main')

@section('content')
<div class="container grid p-2 pb-4">
  @include('partials.header')

  @if($home['cmode'] != config('constants.users.dosen') || $home['cmode'] != config('constants.users.mahasiswa'))
    <input type="hidden" value="{{ $home['unit'] !== '' ? $home['unit'] : 'All' }}" id="user_mode">
    <div class="card overflow-x-auto">
      <div class="card-header">
        <h3 class="card-title"></h3>
        <div class="card-tools">
          <x-button.button-submit type="button" buttonName="Data" buttonIcon="fa-solid fa-table" buttonColor="blue" class="cursor-pointer mr-1" id="btn-data"/>
          <x-button.button-submit type="button" buttonName="Grafik" buttonIcon="fa-solid fa-chart-pie" buttonColor="blue" class="cursor-pointer" id="btn-graphic"/>
        </div>
      </div>
      <div class="card-body">
        <div class="loader flex justify-center items-center">
          <div class="lds-roller hidden"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
        <div id="field" class="">

        </div>
      </div>
    </div>
  @endif

</div>
@endsection
@section('script')
  {{-- <script src="{{ asset('js/script.js') }}"></script> --}}
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/moment.min.js') }}"></script>
  <script src="{{ asset('js/chart.min.js') }}"></script>
  <script src="{{ asset('js/axios.min.js') }}"></script>
  <script src="{{ asset('js/chart.js') }}" type="module"></script>
  <script src="{{ asset('js/pengajuan_proses.js') }}" type="module"></script>
@endsection
