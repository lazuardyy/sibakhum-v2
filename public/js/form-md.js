function searchMhs () {
  // $('#form-md').html('');

  $.ajax({
    url : "http://103.8.12.212:36880/siakad_api/api/as400/dataMahasiswa/" + $('#search-input').val() + '/' + 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6IjE3MDE2MTgwNTYiLCJuYW1hX3VzZXIiOiJNVUtMQVMgTlVSIEFSRElBTlNZQUgiLCJrZWxhbWluIjoiMCIsIm1vZGVfdXNlciI6IjkiLCJ1bml0X3VzZXIiOiIgICAgICIsInN0YXR1c191c2VyIjoiMSJ9.mvnn_XFtapsJ9QkEORi3LOUoWT6j2vHNbyAlBuOg0ms',
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      // console.log(data);
      result = data.isi[0];
      console.log(result);

      $.ajax({
        url : `http://103.8.12.212:36880/siakad_api/api/as400/programStudi/${result.kodeProdi}/eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6IjE3MDE2MTgwNTYiLCJuYW1hX3VzZXIiOiJNVUtMQVMgTlVSIEFSRElBTlNZQUgiLCJrZWxhbWluIjoiMCIsIm1vZGVfdXNlciI6IjkiLCJ1bml0X3VzZXIiOiIgICAgICIsInN0YXR1c191c2VyIjoiMSJ9.mvnn_XFtapsJ9QkEORi3LOUoWT6j2vHNbyAlBuOg0ms`,
        type: 'GET',
        dataType: 'JSON',
        success: function(response) {
          kode_fk = response.isi[0].kodeFakProdi;
          // console.log(response.isi[0].kodeFakProdi);
          $('[name="kode_fakultas"]').attr('value', kode_fk);
        },
        error: function (jqXHR, textStatus, errorMessage) {
          alert(errorMessage);
        }
      })

      $('#nim').attr('placeholder', result.nim).attr('value', result.nim);
      $('#nama').attr('placeholder', result.nama).attr('value', result.nama);
      $('#jenis_kelamin').attr('placeholder', (result.kelamin == 'L') ? 'Laki-Laki' : 'Perempuan');
      $('[name="jenis_kelamin"]').attr('value', (result.kelamin == 'L') ? 0 : 1);
      $('[name="pa"]').attr('value', result.pa);
      $('[name="nama_prodi"]').attr('value', result.namaProdi);
      $('[name="kode_prodi"]').attr('value', result.kodeProdi);
      $('[name="nama_fakultas"]').attr('value', result.namaFakultas);
      $('#nama_fakultas').attr('placeholder', result.namaFakultas);
      $('#nama_prodi').attr('placeholder', result.namaProdi);
      $('[name="jenjang"]').attr('value', result.jenjangProdi);

      $('#search-input').val('');

    },
    error: function (jqXHR, textStatus, errorMessage)
    {
      // $('#form-md').append(`Error ${errorMessage} ${jqXHR} ${textStatus}`)
      alert(errorMessage);
    }
  });
}

// console.log(this.result.nim);

$('#search-button').on('click', function (e) {
  e.preventDefault();
  searchMhs();
})


$('#search-input').on('keyup', function (e) {
  e.preventDefault();
  if(e.which == 13) {
      searchMhs();
  }
})

$('#save-data').click(function (e) {
  e.preventDefault();

  let pa = $('[name="pa"]').val();
  let nim = $('#nim').val();
  let nama = $('#nama').val();
  let jenis_kelamin = $('[name="jenis_kelamin"]').val();
  let nama_fakultas = $('[name="nama_fakultas"]').val();
  let kode_fakultas = $('[name="kode_fakultas"]').val();
  let nama_prodi = $('[name="nama_prodi"]').val();
  let kode_prodi = $('[name="kode_prodi"]').val();
  let jenjang     = $('[name="jenjang"]').val();
  let email = $('#email').val();
  let no_telp = $('#no_telp').val();
  let tahun_angkatan = $('#tahun_angkatan').val();
  let semester = $('#semester').val();
  let keterangan = $('#keterangan').val();
  let jenis_pengajuan = $('[name="jenis_pengajuan"]').val();
  let status_pengajuan = $('[name="status_pengajuan"]').val();
  let _token = $('[name="_token"]').val();

  $.ajax({
    url: "//localhost:3000/pengajuan-mhs/store",
    type : "POST",
    // mode : 'no-cors',
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
      _token:_token
    },
    success: function (response) {
      console.log(response);
      alert(response.success);
    },
    error: function (error) {
      console.log(error);
      alert(error.responseJSON.message);
    }
  })
})
