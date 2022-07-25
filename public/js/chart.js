$(document).ready(function(){
  $('#btn-graphic').click(function() {
    $('.card-title').text('Grafik Data Pengajuan')
    $('#tabel-monitoring').addClass('hidden')

    $('#field').empty().append(`
      <div class="bg-slate-50 shadow-md p-3 rounded-md fields hidden">
        <canvas id="totalPengajuan"></canvas>
      </div>
      <div class="bg-slate-50 shadow-md p-3 rounded-md fields hidden">
        <canvas id="diproses"></canvas>
      </div>
      <div class="bg-slate-50 shadow-md p-3 rounded-md fields hidden">
        <canvas id="per_fakultas"></canvas>
      </div>
      <div class="status">
        <div class="filter flex justify-end bg-slate-50 gap-1">
          <select class="form-select btn border-1 border-sky-500 text-left fields hidden filter-status" id="select-fakultas">

          </select>

          <button type="button" class="btn btn-outline-primary fields hidden filter-status" data-toggle="tooltip" title="Search" id="filter-fakultas"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>

        <div class="bg-slate-50 shadow-md p-3 rounded-md fields hidden">
          <canvas id="per_status"></canvas>
        </div>
      </div>
    `).attr('class', 'grid grid-cols-1 md:grid-cols-2 gap-4')

    const getDataPengajuan = (user) => {
      $.ajax({
        url : 'http://localhost:3000/api/data-pengajuan/fakultas/' + user,
        type: "GET",
        dataType: "JSON",
        beforeSend: function() {
          $('.lds-roller').removeClass('hidden')
        },
        success: function(data)
        {
          const getData = data;

          if(getData.status === 200)
          {
            // config
            $('.fields').removeClass('hidden');

            if(user !== 'All')
            {
              $('.filter-status').remove()
            }

            // const totalPengajuan = document.getElementById('totalPengajuan');
            // const diproses = document.getElementById('diproses');
            // console.log(totalPengajuan);

            // set data
            const getData               = data;
            const getBulan              = getData.data.per_bulan;
            const pengajuanPerFakultas  = getData.data.per_fakultas;
            const pengajuanPerStatus    = getData.data.per_status;

            const bulan           = [];
            const jumlah          = [];
            const pengajuan       = [];
            const progres_status  = [];

            // data fakultas
            const namaFakultas            = [];
            const jumlahPengajuanFakultas = [];
            const jumlahDiprosesFakultas  = [];
            const jumlahDitolakFakultas   = [];
            const jumlahDisetujuiFakultas = [];

            // data untuk admin fakultas
            const ditindaklanjuti = [];
            const ditolak         = [];
            const disetujui       = [];

            for(const pengajuanFakultasList of pengajuanPerFakultas)
            {
              // set select option value
              $('#select-fakultas').append(`
                <option value="${pengajuanFakultasList.kode_fakultas}">${pengajuanFakultasList.nama}</option>
              `)

              // get status pengajuan
              ditindaklanjuti.push(pengajuanFakultasList.pengajuan_diproses)
              ditolak.push(pengajuanFakultasList.pengajuan_ditolak)
              disetujui.push(pengajuanFakultasList.pengajuan_disetujui)

              // get data fakultas
              if(pengajuanFakultasList.nama !== 'MK Universitas' && pengajuanFakultasList.nama !== 'Program Profesi Guru')
              {
                namaFakultas.push(pengajuanFakultasList.nama)
                jumlahPengajuanFakultas.push(pengajuanFakultasList.jumlah_pengajuan)
                jumlahDiprosesFakultas.push(pengajuanFakultasList.pengajuan_diproses)
                jumlahDitolakFakultas.push(pengajuanFakultasList.pengajuan_ditolak)
                jumlahDisetujuiFakultas.push(pengajuanFakultasList.pengajuan_disetujui)
              }
            }

            function jumlahkan(initialValue, currentValue)
            {
              return initialValue + currentValue
            }

            if(user === 'All')
            {
              pengajuan.push(ditindaklanjuti.reduce(jumlahkan))
              pengajuan.push(ditolak.reduce(jumlahkan))
              pengajuan.push(disetujui.reduce(jumlahkan))
            }
            else
            {
              // set progress status keseluruhan
              pengajuan.push(pengajuanPerFakultas[0].pengajuan_diproses, pengajuanPerFakultas[0].pengajuan_ditolak, pengajuanPerFakultas[0].pengajuan_disetujui);

              // set progress status per persetujuan
              progres_status.push(pengajuanPerStatus[0].pa_proses, pengajuanPerStatus[0].prodi_proses, pengajuanPerStatus[0].wd_proses, pengajuanPerStatus[0].wr_proses)
            }

            console.log(progres_status);

            for(const perBulan of getBulan)
            {
              bulan.push(perBulan.nama);
              jumlah.push(perBulan.jumlah)
            }

            // data-data
            let proses = ['PA Proses', 'Prodi Proses', 'WD Proses', 'WR Proses']
            let status = ['Diproses', 'Ditolak', 'Disetujui']

            // insert chart
            chartMonths(bulan, jumlah)

            new Chart(per_fakultas, {
              type: 'bar',
              data: {
                  labels: namaFakultas,
                  datasets: [
                        {
                          label: 'Total Pengajuan',
                          data: jumlahPengajuanFakultas,
                          borderWidth: 2,
                          backgroundColor: 'rgba(54, 162, 235, 0.2)',
                          borderColor: 'rgba(54, 162, 235, 1)',
                          // yAxisID: 'y',
                        },
                        {
                          label: 'Diproses',
                          data: jumlahDiprosesFakultas,
                          borderWidth: 2,
                          backgroundColor : 'rgba(255, 206, 86, 0.2)',
                          borderColor: 'rgba(255, 206, 86, 1)',
                          // yAxisID: 'y1',
                        },
                        {
                          label: 'Ditolak',
                          data: jumlahDitolakFakultas,
                          borderWidth: 2,
                          backgroundColor: 'rgba(255, 99, 132, 0.2)',
                          borderColor: 'rgba(255, 99, 132, 1)',
                          // yAxisID: 'y2',
                        },
                        {
                          label: 'Disetujui',
                          data: jumlahDisetujuiFakultas,
                          borderWidth: 2,
                          backgroundColor: 'rgba(153, 102, 255, 0.2)',
                          borderColor: 'rgba(153, 102, 255, 1)',
                          // yAxisID: 'y3',
                        },
                  ]
              },
              options: {
                responsive: true,
                scales: {
                  x: {
                    stacked: true,
                    ticks: {
                      precision: 0
                    }
                  },
                  y: {
                    stacked: true,
                    ticks: {
                      precision: 0
                    }
                  },
                },
                plugins: {
                  title: {
                    display: true,
                    text: 'Data Pengajuan Per Fakultas'
                  }
                },
              },
            });

            chartStatus('diproses', status, pengajuan)

            // new Chart(diproses, {
            //   type: 'doughnut',
            //   data: {
            //       labels: ['Diproses', 'Ditolak', 'Disetujui'],
            //       datasets: [{
            //           label: 'Pengajuan Diproses',
            //           data: pengajuan,
            //           backgroundColor: [
            //             'rgba(255, 206, 86, 0.2)',
            //             'rgba(255, 99, 132, 0.2)',
            //             'rgba(54, 162, 235, 0.2)',
            //           ],
            //           hoverOffset: 4,
            //           borderColor: [
            //             'rgba(255, 206, 86, 1)',
            //             'rgba(255, 99, 132, 1)',
            //             'rgba(54, 162, 235, 1)',
            //           ],
            //           borderWidth: 2,
            //       }]
            //   },
            //   options: {
            //     responsive: true,
            //     maintainAspectRatio: false,
            //     plugins: {
            //       title: {
            //         display: true,
            //         text: 'Semua Status Pengajuan'
            //       }
            //     },
            //   }
            // });

            chartStatus('per_status', proses, progres_status)
          }

          else
          {
            $('.fields').remove();

            $('#field').append(`
              <div class="alert alert-info text-center w-full" role="alert">
                No data avalaible.
              </div>
            `).attr('class', '')
          }
        },
        error: function(err)
        {
          console.log(err);
        },
        complete: function()
        {
          $('.lds-roller').addClass('hidden')
        }
      })
    }

    const user = $('#user_mode').val()
    getDataPengajuan(user);

    // $('#filter-fakultas').click(function (e) {
    //   e.preventDefault()
    //   const value = $('#select-fakultas option:selected').val();
    //   getDataPengajuan(value)
    // })

    // $('#select-fakultas').change(function () {
    //   const value = $('#select-fakultas option:selected').val();
    //   getDataPengajuan(value)
    // })

  })

  const chartMonths = (bulan, jumlah) => {
    new Chart(totalPengajuan, {
      type: 'line',
      data: {
          labels: bulan,
          datasets: [{
              label: 'Total Pengajuan',
              data: jumlah,
              backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
              ],
              borderColor: [
                'rgba(54, 162, 235, 1)',
              ],
              borderWidth: 2,
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true,
                  ticks: {
                    precision: 0
                  }
              },
          },
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            title: {
              display: true,
              text: 'Data Pengajuan Per Bulan'
            }
          },
      }
    });
  }

  // const data = ['per_status', ['PA Proses', 'Prodi Proses', 'WD Proses', 'WR Proses'], 'pengajuan']

  const chartStatus = (nameChart, labels, data) => {
    new Chart(nameChart, {
      type: 'doughnut',
      data: {
          labels: labels,
          datasets: [{
              label: 'Pengajuan Diproses',
              data: data,
              backgroundColor: [
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
              ],
              hoverOffset: 4,
              borderColor: [
                'rgba(255, 206, 86, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
              ],
              borderWidth: 2,
          }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          title: {
            display: true,
            text: 'Semua Status Pengajuan'
          }
        },
      }
    });
  }

})





