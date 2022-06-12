@extends('layouts.main')
@section('content')
  @include('partials.header')

  <section class="content">
    @if ($cmode == '3' || $cmode == '14' || $cmode == '20')
      @include('layouts.infobox')
    @endif

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">{{ config('app.name', '') }}</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
          Selamat Datang
          <strong class="mr-1">{{ $user }}</strong>di {{ config('app.name', '') }}!
      </div>
    </div>
  </section>
@endsection
