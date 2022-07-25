$(document).ready(function(){
  const getDataPengajuan = (user) => {
    $.ajax({
      url: 'http://localhost:3000/api/data-pengajuan/fakultas/' + user,
      type: 'GET',
      dataType: 'JSON',
      beforeSend: function () {
        $('.lds-roller').removeClass('hidden')
      },
      success: function (data) {
        if(data.status === 200)
        {
          $('#tabel-monitoring').removeClass('hidden').addClass('table')


          const retrieveData = data.data
          const dataPerStatus = retrieveData.per_status
          const dataPerFakultas = retrieveData.per_fakultas

          for(const [i, dataPerStatusList] of dataPerStatus.entries())
          {
            $('#field-value').append(`
              <tr>
                <td>${i+1}</td>
                <td>${dataPerStatusList.nama}</td>
                <td>${dataPerStatusList.pa_proses}</td>
                <td>${dataPerStatusList.prodi_proses}</td>
                <td>${dataPerStatusList.wd_proses}</td>
                <td>${dataPerStatusList.wr_proses}</td>
                <td>${dataPerFakultas[i].pengajuan_ditolak}</td>
                <td>${dataPerFakultas[i].pengajuan_disetujui}</td>
                <td>${dataPerFakultas[i].jumlah_pengajuan}</td>
              </tr>
            `).attr('class', '')
          }
        }

        else
        {
          $('#field').append(`
            <div class="alert alert-info text-center w-full" role="alert">
              No data avalaible.
            </div>
          `).attr('class', '')
        }
      },
      error: function (err) {
        console.log(err);
      },
      complete: function () {
        $('.lds-roller').addClass('hidden')
      }
    })
  }

  const user = $('#user_mode').val()

  $('#btn-data').click(function(){
    $('.card-title').text('Monitoring Pengajuan')

    $('#field').empty().append(`
      <table class="hidden" id="tabel-monitoring">
        <thead>
          <tr>
          <th scope="col">No</th>
          <th scope="col">Fakultas</th>
          <th scope="col">Diproses PA</th>
          <th scope="col">Diproses KoorProdi</th>
          <th scope="col">Diproses WD 1</th>
          <th scope="col">Diproses WR 1</th>
          <th scope="col">Ditolak</th>
          <th scope="col">Disetujui</th>
          <th scope="col">Total Pengajuan</th>
        </thead>
        <tbody id="field-value">
        </tbody>
      </table>
    `).attr('class', '')
    getDataPengajuan(user)
  })
})
