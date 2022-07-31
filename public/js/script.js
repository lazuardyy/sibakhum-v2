$(function() {
  $('#tabel-dosen').DataTable({
    columnDefs: [
      {
        targets: [0, 1, 2, 3, 4, 5, 6,],
        className: ['dt-head-center'],
      },

  ],
    "responsive": true,
  });


  $('#table-all-data').DataTable({
    columnDefs: [
      {
        targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
        className: ['dt-head-center'],
      },
      {
        targets: [0, 8, 10],
        orderable: false,
      },
    ],
    "responsive": true,
  });

  let user_mode = $('#user_mode').val()
  let data_table = []
  if(user_mode == 3 || user_mode == 4)
  {
    data_table.push(0, 1, 2, 3, 4)
  }
  else
  {
    data_table.push(0, 1, 2, 3, 4, 5)
  }
  console.log(data_table);

  $('#tabel-history').DataTable({
    columnDefs: [
      {
        targets: data_table,
        className: ['dt-head-center'],
      },
    ],
    "responsive": true,
  });

  $('#tabel-md').DataTable({
    "responsive": true,
    'searching': false,
    'paging': false,
    // 'scrollX': true,
  });

  $('#tabel-cuti').DataTable({
    "responsive": true,
    'searching': false,
    'paging': false,
    columnDefs: [{
      targets: [0, 1, 2, 3, 4, 5, 6],
      className: ['dt-head-center'],
    }]
    // 'scrollX' : true,
  });
});
