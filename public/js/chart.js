const totalPengajuan = document.getElementById('totalPengajuan');
const diproses = document.getElementById('diproses');

const getDataPengajuan = async () => {
  const request = await fetch('http://localhost:3000/api/data-pengajuan/fakultas/17')
  const response = await request.json();

  const getData = response.data;
  // console.log(Object.keys(getData)[0]);

  new Chart(totalPengajuan, {
    type: 'bar',
    data: {
        labels: ['Januari', 'Februari', 'Maret'],
        datasets: [{
            label: 'Total Pengajuan',
            data: [getData.total_pengajuan,],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
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


        }
    }
  });

  new Chart(diproses, {
    type: 'bar',
    data: {
        labels: ['Januari',],
        datasets: [{
            label: 'Pengajuan Diproses',
            data: [getData.pengajuan_diproses,],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                  precision: 0
                }
            }
        }
    }
  });
}

getDataPengajuan();






