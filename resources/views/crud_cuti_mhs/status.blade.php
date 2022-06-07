@extends('layouts.main')

@section('content')
  <div class="container grid p-2 gap-4">
    @include('partials.header')

    <div class="bg-slate-50 shadow-md p-3 rounded-md">
      <div>
        <table class="table table-striped table-bordered" id="tabel-mhs">
          <thead>
            <tr>
              <th>Diajukan kepada</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($students as $student)
              <tr>
                <td>{{ $pa }}</td>
                  @if(isset($student->detailCutiMhs->status_persetujuan_pa))
                    @if($student->detailCutiMhs->status_persetujuan_pa == 1)
                      <td>Disetujui</td>
                    @elseif($student->detailCutiMhs->status_persetujuan_pa == 0)
                      <td>Ditolak</td>
                    @else
                      <td>Menunggu</td>
                    @endif
                  @endif
              </tr>
              <tr>
                <td>{{ $koordProdi }}</td>
                @if(isset($student->detailCutiMhs->status_persetujuan_koorprodi))
                    @if($student->detailCutiMhs->status_persetujuan_koorprodi == 1)
                      <td>Disetujui</td>
                    @elseif($student->detailCutiMhs->status_persetujuan_koorprodi == 0)
                      <td>Ditolak</td>
                    @else
                      <td>Menunggu</td>
                    @endif
                  @endif
              </tr>
              <tr>
                <td>{{ $wd_1 }}</td>
                @if(isset($student->detailCutiMhs->status_persetujuan_wd1))
                    @if($student->detailCutiMhs->status_persetujuan_wd1 == 1)
                      <td>Disetujui</td>
                    @elseif($student->detailCutiMhs->status_persetujuan_wd1 == 0)
                      <td>Ditolak</td>
                    @else
                      <td>Menunggu</td>
                    @endif
                  @endif
              </tr>
              <tr>
                <td>WR 1</td>
                @if(isset($student->detailCutiMhs->status_persetujuan_wr1))
                    @if($student->detailCutiMhs->status_persetujuan_wr1 == 1)
                      <td>Disetujui</td>
                    @elseif($student->detailCutiMhs->status_persetujuan_wr1 == 0)
                      <td>Ditolak</td>
                    @else
                      <td>Menunggu</td>
                    @endif
                  @endif
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="button">
      <a class="px-3 py-2.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out" href="{{ url('home') }}">
        kembali
      </a>
    </div>
  </div>
@endsection
