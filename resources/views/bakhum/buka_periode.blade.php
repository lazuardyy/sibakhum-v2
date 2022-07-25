@extends('layouts.main')

@section('content')
<div class="container grid p-2 pb-4">
  @include('partials.header')
  @include('flash-message')

  <section class="content overflow-x-auto">
    <div class="card">
      <div class="card-header">
        <button type="button" class="btn btn-outline-primary" id="btnTambahPeriode" data-bs-toggle="modal" data-bs-target="#modal-periode"><i class="ace-icon fa fa-plus"></i> Periode Baru</button>
      </div>
      <div class="card-body">
        @if ($errors->any())
          <div class="alert alert-danger mt-2">
            <ul style="margin-bottom: 0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="table-responsive">
          <table id="dataTabel" class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Aktif</th>
                <th scope="col">Kode Semester</th>
                <th scope="col">Semester</th>
                <th scope="col">Mulai Pembukaan</th>
                <th scope="col">Akhir Pembukaan</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($periode as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                    <div class="form-check form-switch">
                        <form id="formCheck_{{ $item->id }}" action="{{ route('periode.activate') }}" method="POST">
                            @csrf
                            @method('post')
                            <input type="hidden" id="id_periode" name="id_periode" value="{{ $item->id }}">
                            <input type="hidden" id="aktifCheck" name="aktifCheck" value="{{ $item->aktif }}">
                            <input class="form-check-input" type="checkbox" role="switch" value="{{ $item->aktif }}" {{ ($item->aktif == '1') ? 'checked':'' }} onclick="document.getElementById('formCheck_{{ $item->id }}').submit()">
                        </form>

                    </div>
                  </td>
                  <td>{{ $item->semester }}</td>
                  <td>{{ $item->des_semester }}</td>
                  <td>{{ date('D, d M Y', strtotime($item->start_date)) }}</td>
                  <td>{{ date('D, d M Y', strtotime($item->end_date)) }}</td>
                  <td class="btn-group text-center">
                    <button type="button" class="mr-1 btn btn-sm btn-warning hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out rounded-md" data-toggle="tooltip" data-placement="top" title="Edit Data" onclick="editPeriode({{ $item->id }})">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </button>

                    <form action="{{ route('periode.destroy', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out rounded-md" data-toggle="tooltip" data-placement="top" title="Hapus Data" onclick="return confirm('Apakah Anda yakin akan menghapus periode ini?')">
                          <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>

                  </td>
                </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div id="modal-periode" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header py-2">
            <h5 class="modal-title">Buka Periode Pengajuan Cuti</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="modal-body py-2">
              <form id="formAddPeriode" action="{{ route('periode.store') }}" method="POST">
                @csrf
                <div class="form-body">
                    <div class="form-group">
                        <label for="semester">Kode Semester</label>
                        <input type="text" class="form-control form-control-border" name="semester" id="semester"  required>
                    </div>
                    <div class="form-group">
                        <label for="des_semester">Semester</label>
                        <input type="text" class="form-control form-control-border" name="des_semester" id="des_semester"  required>
                    </div>
                    <div class="form-group">
                        <label>Mulai Pembukaan</label>
                          <div class="input-group date" id="start_date" data-bs-target-input="nearest">
                              <input type="date" class="form-control form-control-border datetimepicker-input" data-bs-target="#start_date" id="start_date" name="start_date" required/>
                              <div class="input-group-append" data-bs-target="#start_date" data-bs-toggle="datetimepicker">

                              </div>
                          </div>
                    </div>
                    <div class="form-group">
                        <label>Akhir Pembukaan</label>
                          <div class="input-group date" id="end_date" data-bs-target-input="nearest">
                              <input type="date" class="form-control form-control-border datetimepicker-input" data-bs-target="#end_date" id="end_date" name="end_date" required/>
                              <div class="input-group-append" data-bs-target="#end_date" data-bs-toggle="datetimepicker">

                              </div>
                          </div>
                    </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer py-2">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" onclick="document.getElementById('formAddPeriode').submit()">Simpan</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('script')
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/moment.min.js') }}"></script>
  <script>
    $(document).ready(function() {

      // $("#dataTabel1").DataTable({
      //   "responsive": true,
      //   "lengthChange": false,
      //   "autoWidth": false,
      //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

      $('#dataTabel').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

      //Date and time picker
        $('#start_date').datetimepicker({
            icons: { time: 'far fa-clock' }
        });
        $('#end_date').datetimepicker({
            icons: { time: 'far fa-clock' }
        });

    });

    function editPeriode(id) {
        //alert(id);
        //Ajax Load data from ajax
        $.ajax({
            url : "/buka-periode/edit/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                console.log (data);
                $('[name="semester"]').val(data.semester);
                $('[name="des_semester"]').val(data.des_semester);
                $('[name="start_date"]').val(convertDate(data.start_date));
                $('[name="end_date"]').val(convertDate(data.end_date));

                $("#modal-periode").modal('show');
                $('.modal-title').text('Edit Periode Pengajuan Cuti');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }


    function convertDate(date) {
        var momentDate = moment(date).format('MM/DD/y hh:ss A');
        return momentDate;
    }
  </script>

@endsection
