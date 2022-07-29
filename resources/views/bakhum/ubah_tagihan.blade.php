@extends('layouts.main')

@section('content')
<div class="container">
  @include('partials.header')
  @include('flash-message')

  <div class="card">
    <div class="card-header">
      <div class="card-title">
        Halaman ini dalam tahap pengembangan
      </div>
    </div>
    <div class="card-body">

      <div class="progress">
        <div class="progress-bar bg-danger" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
      </div>
    </div>
  </div>
</div>
@endsection
