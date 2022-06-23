function searchMhs () {
  $('#form-md').html('');

  $.ajax({
    url : "http://103.8.12.212:36880/siakad_api/api/as400/dataMahasiswa/" + $('#search-input').val() + '/' + 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6IjE3MDE2MTgwNTYiLCJuYW1hX3VzZXIiOiJNVUtMQVMgTlVSIEFSRElBTlNZQUgiLCJrZWxhbWluIjoiMCIsIm1vZGVfdXNlciI6IjkiLCJ1bml0X3VzZXIiOiIgICAgICIsInN0YXR1c191c2VyIjoiMSJ9.mvnn_XFtapsJ9QkEORi3LOUoWT6j2vHNbyAlBuOg0ms',
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      result = data.isi[0];
      csrf = '<?php echo @csrf ?>';
      // console.log(result);
      $('#form-md').append(`
        ${csrf}
        <div>
          <div class="form-group mb-6">
            <label for="NIM" class="form-label inline-block mb-2 text-gray-700">NIM</label>
            <input type="hidden" name="nim" value="${result.nim}">
            <input type="hidden" name="pa" value="${result.pa}">
            <input type="hidden" name="nama_prodi" value="${result.namaProdi}">
            <input type="hidden" name="nama_fakultas" value="${result.namaFakultas}">

            <input type="text"
              class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              id="NIM"
              aria-describedby="NIM"
              placeholder="${result.nim}"
              readonly
            >
          </div>

          <div class="form-group mb-6">
            <label for="nama" class="form-label inline-block mb-2 text-gray-700">Nama Lengkap</label>
            <input type="hidden" name="nama" value="${result.nama}">
            <input type="text"
              class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              id="nama"
              aria-describedby="nama"
              placeholder="${result.nama}"
              readonly
            >
          </div>

          <div class="form-group mb-6">
            <label for="jenis_kelamin" class="form-label inline-block mb-2 text-gray-700">Jenis Kelamin</label>
            <input type="hidden" name="jenis_kelamin" value="${(result.kelamin == 'L') ? 0 : 1 }">
            <input type="text"
              class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              id="jenis_kelamin"
              required
              aria-describedby="jenis_kelamin"
              placeholder="${(result.kelamin == 'L') ? 'Laki-Laki' : 'Perempuan'}"
              readonly
            >
          </div>

          <div class="form-group mb-6">
            <label for="kode_fakultas" class="form-label inline-block mb-2 text-gray-700">Fakultas</label>
            <input type="hidden" name="kode_fakultas" value="{{ $pengajuan['kode_fakultas'] }}">

            <input type="text"
              class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              id="kode_fakultas"
              required
              aria-describedby="kode_fakultas"
              placeholder="${result.namaFakultas}"
              readonly
            >
          </div>

          <div class="form-group mb-6">
            <label for="kode_prodi" class="form-label inline-block mb-2 text-gray-700">Program Studi</label>
            <input type="hidden" name="kode_prodi" value="${result.kodeProdi}">

            <input type="text"
              class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              id="kode_prodi"
              required
              aria-describedby="kode_prodi"
              placeholder="${result.namaProdi}"
              readonly
            >

          </div>
        </div>

        <div>
          <div class="form-group mb-6">
            <label for="no_telp" class="form-label inline-block mb-2 text-gray-700">No. Telp</label>
            <input type="tel"
              class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              id="no_telp"
              required
              aria-describedby="no_telp"
              placeholder="Masukkan nomor telepon aktif kamu"
              name="no_telp"
            >
            <small id="emailHelp" class="block mt-1 text-xs text-gray-600">Masukkan nomor handphone aktif.</small>
          </div>

          <div class="form-group mb-6">
            <label for="tahun_angkatan" class="form-label inline-block mb-2 text-gray-700">Tahun Angkatan</label>
            <input type="number"
              class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              id="tahun_angkatan"
              required
              aria-describedby="tahun_angkatan"
              min="2015" max="2022" step="1"
              name="tahun_angkatan"
            >
          </div>

          <div class="form-group mb-6">
            <label for="semester" class="form-label inline-block mb-2 text-gray-700">Semester</label>
            <select id="semester" name="semester"
              class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
              @for($i = 3; $i <= 8; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
              @endfor
            </select>
          </div>

          <div class="form-group mb-6">
            <label for="keterangan" class="form-label inline-block mb-2 text-gray-700">Keterangan</label>
            <textarea
              class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              id="keterangan"
              required
              aria-describedby="keterangan"
              placeholder="Jelaskan alasan pengunduran diri"
              name="keterangan"
              rows="5"
              style="resize: none;"
              ></textarea>
          </div>

          <div class="flex gap-2">
            <a href="{{ url('home') }}" class="px-3 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
              <i class="fa-solid fa-ban"></i>
              <span class="text-xs lg:text-md">Batal</span>
            </a>

              <button type="submit"
                class="px-3 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                >
                  <i class="fa-solid fa-floppy-disk"></i>
                  <span class="text-xs lg:text-md">Ajukan</span>
              </button>
          </div>
        </div>

      `)

      $('#search-input').val('');
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
      alert('Error get data from ajax');
    }
  });
}

$('#search-button').on('click', function () {
  searchMhs();
})


$('#search-input').on('keyup', function (e) {
  if(e.which == 13) {
      searchMhs();
  }
})
