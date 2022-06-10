// async function userSiakad () {
//   let data = await fetch ('http://103.8.12.212:36880/siakad_api/api/as400/signin');
//   let response = await data.formData();
//   console.log(response);
// }

// userSiakad()

$(function() {
  // $('#tabel-data').DataTable({
  //   processing: true,
  //   serverSide: true,
  //   ajax: '{!! route('data') !!}',
  //   columns: [
  //     { data: 'id', name: 'id' },
  //     { data: 'username', name: 'username' },
  //     { data: 'role', name: 'role' },
  //     { data: 'email', name: 'email' },
  //     { data: 'aksi', name: 'aksi' },
  //   ]
  // });

  $('#tabel-dosen').DataTable({
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
    // 'scrollX' : true,
  });
});
