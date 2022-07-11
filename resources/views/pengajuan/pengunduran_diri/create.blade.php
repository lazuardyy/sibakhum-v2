@extends('layouts.main')

@section('content')
<div class="container grid p-2 pb-4">
  @include('partials.header')
  @include('flash-message')

  <div id="loader" class="lds-dual-ring hidden overlay"></div>

  <div class="flex justify-center">
    <div class="mb-3 xl:w-2/4 flex mt-3" >
        <input type="text" class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Masukkan NIM mahasiswa ..." aria-label="Search" aria-describedby="button-addon2" id="search-input">

        <button type="button" class="btn btn-primary" id="search-button">
          <i class="fa-solid fa-magnifying-glass text-md"></i>
        </button>
    </div>
  </div>

  <hr>

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul style="margin-bottom: 0">
            @foreach ($errors->all() as $error)
             <li> <i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <div class="p-6 rounded-lg shadow-md bg-white hidden" id="form-md">
    <form action="{{ route('pengajuan-mhs.store') }}" method="POST" class="md:grid md:grid-cols-2 gap-x-7" enctype="multipart/form-data" id="form">
      @csrf

      <div>
        {{-- <input type="hidden" name="pa" value=""> --}}
        {{-- <input type="hidden" name="nama_prodi" value=""> --}}
        {{-- <input type="hidden" name="nama_fakultas" value=""> --}}
        <input type="hidden" name="jenis_pengajuan" value="2">
        <input type="hidden" name="status_pengajuan" value="2">
        <input type="hidden" name="kode_prodi" value="">
        <input type="hidden" name="kode_fakultas" value="">
        <input type="hidden" name="user_unit" value="{{ trim(session('user_unit')) }}">
        {{-- <input type="hidden" name="jenjang" value=""> --}}

          @foreach($datas as $key => $data)
            @if($data['id'] <= 7)
              <div class="form-group mb-6">
                <label for="{{ $data['typeInput'] }}" class="form-label inline-block mb-2 text-gray-700">{{ $data['title'] }}</label>

                @if($data['typeInput'] != 'jenis_kelamin' && $data['typeInput'] != 'nama_prodi' && $data['typeInput'] != 'jenjang' && $data['typeInput'] != 'nama_fakultas')
                  <x-inputs.input typeInput="{{ $data['typeInput'] }}" type="{{ $data['type'] }}" message="" note="{{ $data['note'] }}" value="" placeholder="{{ $data['placeholder'] }}"/>
                @elseif($data['typeInput'] == 'jenis_kelamin')
                  <select name="{{ $data['typeInput'] }}" id="{{ $data['typeInput'] }}" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                    <option id="option_title">Pilih jenis kelamin</option>
                    <option value="0">Laki-Laki</option>
                    <option value="1">Perempuan</option>
                  </select>
                @else
                  <select name="{{ $data['typeInput'] }}" id="{{ $data['typeInput'] }}" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                    <option id="{{ $data['typeInput'] }}"></option>
                    {{-- <option value="" id="prodi"></option> --}}
                  </select>
                @endif
              </div>
            @endif
          @endforeach
      </div>
      <div>
        @foreach($datas as $key => $data)
        @if($data['id'] > 7)
          <div class="form-group mb-6">
            <label for="{{ $data['typeInput'] }}" class="form-label inline-block mb-2 text-gray-700">{{ $data['title'] }}</label>

            @if($data['typeInput'] != 'keterangan')
              <x-inputs.input typeInput="{{ $data['typeInput'] }}" type="{{ $data['type'] }}" message="" note="{{ $data['note'] }}" value="" placeholder="{{ $data['placeholder'] }}"/>
            @else
              <textarea
                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                id="{{ $data['typeInput'] }}"
                required
                aria-describedby="{{ $data['typeInput'] }}"
                placeholder="{{ $data['placeholder'] }}"
                name="{{ $data['typeInput'] }}"
                rows="5"
                style="resize: none;"
                value="{{ old($data['typeInput']) }}"
              ></textarea>
                @error($data['typeInput'])
                  <small id="{{ $data['typeInput'] }}" class="block mt-1 text-xs text-red-600">
                    {{ $message }}
                  </small>
                @enderror
            @endif
          </div>
        @endif
        @endforeach

        <div class="flex gap-2 flex-end">
          <x-button.button-href buttonName="batal" btnColor="red" href="/home" buttonIcon="fa-solid fa-ban"/>
          <x-button.button-submit buttonName="ajukan" type="submit" id="save-data" buttonColor="green" buttonIcon="fa-solid fa-floppy-disk"/>
        </div>
      </div>
    </form>
  </div>

  <div id="not-found" class="hidden">
    <div class="flex flex-col items-center justify-center p-4">
      <div class="text-center">
        <h1 class="text-gray-700 text-4xl font-bold">
          <i class="fa-solid fa-exclamation-triangle text-red-600"></i>
        </h1>
        <p class="text-gray-700 text-lg">
          Maaf, data tidak ditemukan.
        </p>
      </div>

      <div class="buat-baru">
        <button id="buat-baru" class="px-3 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
          <i class="fa-solid fa-plus"></i>
          <span class="text-xs lg:text-md">Buat Baru</span>
        </button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
  <script src="{{ asset('js/form-md.js') }}" type="text/javascript"></script>
  {{-- <script>
    $(document).ready(function () {

      $('#form').submit(function (e) {
        e.preventDefault();

        let pa = $('[name="pa"]').val();
        let jenis_kelamin = $('[name="jenis_kelamin"]').val();
        let nama_fakultas = $('[name="nama_fakultas"]').val();
        let kode_fakultas = $('[name="kode_fakultas"]').val();
        let nama_prodi = $('[name="nama_prodi"]').val();
        let kode_prodi = $('[name="kode_prodi"]').val();
        let jenjang     = $('[name="jenjang"]').val();
        let jenis_pengajuan = $('[name="jenis_pengajuan"]').val();
        let status_pengajuan = $('[name="status_pengajuan"]').val();
        let nim = $('#nim').val();
        let nama = $('#nama').val();
        let email = $('#email').val();
        let no_telp = $('#no_telp').val();
        let tahun_angkatan = $('#tahun_angkatan').val();
        let semester = $('#semester').val();
        let keterangan = $('#keterangan').val();
        let file_pengajuan = new FormData(document.getElementById('form'));
        let _token = $('[name="_token"]').val();

        $.ajax({
          url: "{{ route('pengajuan-mhs.store') }}",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type : "POST",
          dataType: 'JSON',
          contentType: false,
          processData: false,
          data: {
            pa:pa,
            nim:nim,
            nama:nama,
            jenis_kelamin:jenis_kelamin,
            nama_fakultas:nama_fakultas,
            kode_fakultas:kode_fakultas,
            nama_prodi:nama_prodi,
            kode_prodi:kode_prodi,
            jenjang:jenjang,
            email:email,
            no_telp:no_telp,
            tahun_angkatan:tahun_angkatan,
            semester:semester,
            keterangan:keterangan,
            jenis_pengajuan:jenis_pengajuan,
            status_pengajuan:status_pengajuan,
            file_pengajuan_md:file_pengajuan,
            _token:_token
          },
          beforeSend: function() {
            $('#loader').removeClass('hidden')
          },
          success: function (response) {
            console.log(response);
            alert(response.success);
          },
          complete: function(){
            $('#loader').addClass('hidden')
          },
          error: function (error) {
            console.log(error);
            alert(error.responseJSON.message);
          }
        })
      })
    })
  </script> --}}
@endsection
