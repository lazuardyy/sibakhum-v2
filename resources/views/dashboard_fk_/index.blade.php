@extends('layouts.main')

@section('content')
<div class="container grid p-2 gap-4">
  @include('partials.header')
  @include('partials.welcome')
  @include('flash-message')

  <div class="bg-slate-50 shadow-md p-3 rounded-md">
      <table class="w-full mb-3 pt-3" id="tabel-dosen">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Lengkap</th>
            <th>NIM</th>
            {{-- <th>Program Studi</th> --}}
            <th>Tahun Angkatan</th>
          </tr>
        </thead>
        <tbody>
          @foreach($faculty->students as $index => $student)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $student->nama }}</td>
              <td>{{ $student->nim }}</td>
              {{-- <td>{{ $student->prodi }}</td> --}}
              <td>{{ $student->tahun_angkatan }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
  </div>
</div>
@endsection

