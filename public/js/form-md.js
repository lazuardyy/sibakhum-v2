// const { data } = require("jquery");

function searchMhs () {
  // $('#form-md').html('');
  $.ajax({
    url : "http://103.8.12.212:36880/siakad_api/api/as400/dataMahasiswa/" + $('#search-input').val() + '/' + 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6IjE3MDE2MTgwNTYiLCJuYW1hX3VzZXIiOiJNVUtMQVMgTlVSIEFSRElBTlNZQUgiLCJrZWxhbWluIjoiMCIsIm1vZGVfdXNlciI6IjkiLCJ1bml0X3VzZXIiOiIgICAgICIsInN0YXR1c191c2VyIjoiMSJ9.mvnn_XFtapsJ9QkEORi3LOUoWT6j2vHNbyAlBuOg0ms',
    type: "GET",
    dataType: "JSON",
    beforeSend: function() {
      $('#loader').removeClass('hidden')
    },
    success: function(data)
    {
      if(data.status === true) {
        result = data.isi[0];

        let kode_prodi = result.kodeProdi;
        let kode_fk = kode_prodi.split("").slice(0, 2).join('');

        $('#form-md').removeClass('hidden').addClass('block');
        $('#not-found').removeClass('block').addClass('hidden');

        $('[name="pa"]').attr('value', result.pa).attr('placeholder', 'Masukkan NIP pembimbing akademik');
        $('#nim').attr('placeholder', result.nim).attr('value', result.nim);
        $('#nama').attr('placeholder', result.nama).attr('value', result.nama);
        $(`select option[value=${(result.kelamin == 'L') ? '0' : '1'}]`).attr("selected","selected");
        $('select option[id="nama_fakultas"]').text('Pilih fakultas')
        $('#nama_fakultas').append(`
          <option value="${result.namaFakultas}" selected="selected">${result.namaFakultas}</option>
        `)
        $('[name="kode_fakultas"]').attr('value', kode_fk);
        $('[name="kode_prodi"]').attr('value', result.kodeProdi);
        $('#nama_prodi').append(`
          <option value="${result.namaProdi}" selected="selected">${result.namaProdi}</option>
        `)
        $('#jenjang').append(`
          <option value="${result.jenjangProdi}" selected="selected">${result.jenjangProdi}</option>
        `)
        $('#tahun_angkatan').attr('value', result.angkatan);

        $('#search-input').val('');
      }
      else {
        result = data.pesan;
        $('#not-found').removeClass('hidden').addClass('block');
        $('#form-md').removeClass('block').addClass('hidden');

        $('#buat-baru').click(function() {
          $('#form-md').removeClass('hidden').addClass('block');
          $('#not-found').removeClass('block').addClass('hidden');

          $('[name="pa"]').attr('value', '').attr('placeholder', 'Masukkan NIP pembimbing akademik');
          $('#nim').attr('placeholder', 'Masukkan NIM kamu').attr('value', '');
          $('#nama').attr('placeholder', 'Masukkan nama lengkap kamu').attr('value', '');
          $('#tahun_angkatan').attr('value', '');

          let user_unit = $('[name="user_unit"]').val();

          $.ajax({
            url: `http://103.8.12.212:36880/siakad_api/api/as400/programStudi/${user_unit}`,
            type: 'GET',
            dataType: 'JSON',
            beforeSend: function () {
              $('#loader').removeClass('hidden')
            },
            success: function (data) {
              result = data.isi;
              // console.log(result);
              let nama_fakultas = result[0].namaFakultas;
              let kode_fakultas = result[0].kodeFakProdi;
              // console.log(nama_fakultas);

              // set data
              $('#nama_fakultas').append(`
                <option value="${nama_fakultas}" selected="selected">${nama_fakultas}</option>
              `)
              $('select option[id="jenjang"]').text('Pilih jenjang')
              $('select option[id="nama_prodi"]').text('Pilih program studi')
              $('select option[id="nama_fakultas"]').text('Pilih fakultas')
              $('[name="kode_fakultas"]').attr('value', kode_fakultas)
              $('#nama_prodi').on('change', function () {
                $('[name="kode_prodi"]').attr('value', $(this).children(":selected").attr('id'))
              })
              // console.log($(`select[name="nama_prodi"] option`).filter(':selected').attr('id'))
              let d3 = [];
              let d4 = [];
              let s1 = [];
              let s2 = [];

              for(const prodiItem of result) {
                $('#nama_prodi').append(`
                  <option value="${prodiItem.namaProdi}" id="${prodiItem.kodeProdi}">${prodiItem.namaProdi}</option>
                `)

                // console.log(prodiItem);
                if(prodiItem.jenjangProdi == 'D3') {
                  d3.push(prodiItem.jenjangProdi)
                }
                else if(prodiItem.jenjangProdi == 'D4') {
                  d4.push(prodiItem.jenjangProdi)
                }
                else if(prodiItem.jenjangProdi == 'S1') {
                  s1.push(prodiItem.jenjangProdi)
                }
                else {
                  s2.push(prodiItem.jenjangProdi)
                }
              }

              let jenjangD3 = d3.slice(0, 1).join('')
              let jenjangD4 = d4.slice(0, 1).join('')
              let jenjangS1 = s1.slice(0, 1).join('')
              let jenjangS2 = s2.slice(0, 1).join('')
              let semuaJenjang = [jenjangD3, jenjangD4, jenjangS1, jenjangS2]
              // console.log(semuaJenjang);
              for(const semuaJenjangList of semuaJenjang) {
                if(semuaJenjangList !== '') {
                  $('#jenjang').append(`
                    <option value="${semuaJenjangList}">${semuaJenjangList}</option>
                  `)
                }
                // console.log(semuaJenjangList);
              }
            },
            complete: function () {
              $('#loader').addClass('hidden')
            },
            error: function (err) {
              alert(err);
            }
          })
        })
      }

    },
    complete: function(){
      $('#loader').addClass('hidden')
    },
    error: function (jqXHR, textStatus, errorMessage)
    {
      // $('#form-md').append(`Error ${errorMessage} ${jqXHR} ${textStatus}`)
      alert(errorMessage);
    }
  })
}

$('#search-button').on('click', function (e) {
  e.preventDefault();
  searchMhs();
  // console.log(datas);
})

// console.log(datas);


$('#search-input').on('keyup', function (e) {
  e.preventDefault();
  if(e.which == 13) {
    searchMhs();
  }
})


