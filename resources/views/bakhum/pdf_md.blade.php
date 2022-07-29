<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Surat Keterangan_{{ $pengajuan->nama }}_{{ $pengajuan->nim }}</title>
  <style>
    h1, h2, h3, h4, h5, h6 {
      margin-bottom: 0;
      padding: 0;
      margin-top: 0;
    }

    .ttd {
      display: flex;
      flex-direction: column;
    }

    p {
      text-align: justify;
    }

    img {
      width: 80px;
    }

    .title, .subtitle {
      text-align: center;
    }
    table:not(2) {
      width: 100%;
    }

    section table {
      padding-left: 2rem;
    }
  </style>
</head>
<body>
  <header style="" class="header">
    <table>
      <tr>
        <td><img src="assets/img/unj.png" alt="logo"></td>
        <td>
          <div class="kop_surat" style="text-align: center; padding-right: 1rem;" >
            <h3 style="margin-bottom: 0">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, <br> RISET DAN TEKNOLOGI</h3>
            <h3 style="margin-bottom: 0; margin-top:0; letter-spacing: 2;">UNIVERSITAS NEGERI JAKARTA</h3>
            <small>Kampus Universitas Negeri Jakarta, Jl. Rawamangun Muka, Jakarta 13220 <br> Telp: Rektor: (021) 4893854, WR 1:  4895130, WR II: 4893918, WR III: 4892926, WR IV: 4893982 <br> BUK: 4750930, BAKHUM: 4759081, 4893668, BK: 4752180, <br> Bag. UHTP: Telp. 4890046, Bag. Keuangan: 4892414 Bag. Kepegawaian: 4890536 <br> Laman: www.unj.ac.id</small>
          </div>
        </td>
      </tr>
    </table>
    <hr>
  </header>

  <main>
    <section style="text-align: center;">
      <h2 style="text-transform: uppercase; text-decoration:underline;">surat keterangan</h2>
      <h3>Nomor: {{ $pengajuan->no_surat_bakhum }}</h3>
    </section>

    <section class="content">
      <p style="text-align: justify;">Kepala Biro Akademik, Kemahasiswaan dan Hubungan Masyarakat Universitas Negeri Jakarta menerangkan bahwa:
      </p>
    </section>

    <section class="identitas">
      <table style="padding-left: 2rem">
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td>{{ $pengajuan->nama }}</td>
        </tr>
        <tr>
          <td>Nomor Registrasi</td>
          <td>:</td>
          <td>{{ $pengajuan->nim }}</td>
        </tr>
        <tr>
          <td>Tempat, Tanggal Lahir</td>
          <td>:</td>
          <td>{{ $mhs->tempatLahir }}, {{ date('d M Y', strtotime($mhs->tanggalLahir)) }}</td>
        </tr>
        <tr>
          <td>Fakultas</td>
          <td>:</td>
          <td>{{ $pengajuan->nama_fakultas }}</td>
        </tr>
        <tr>
          <td>Program Studi</td>
          <td>:</td>
          <td>{{ $pengajuan->nama_prodi }}</td>
        </tr>
        <tr>
          <td>Jenjang</td>
          <td>:</td>
          <td>{{ $pengajuan->jenjang }}</td>
        </tr>
      </table>

      <p>Adalah mahasiswa Universitas Negeri Jakarta yang telah terdaftar pada semester.</p>
      <p><strong>Mata kuliah yang telah ditempuh dan lulus terlampir.</strong></p>
      <p>Demikian surat keterangan ini dibuat agar dapat dipergunakan seperlunya.</p>
    </section>

    <section class="closing">

    </section>

    <br>
    <section class="ttd" style="overflow: auto; padding-top: 3rem">
      <div style="width: 40%; float: right;">
        <span>Jakarta, {{ date('d M Y') }}</span>
        <br>
        <span>Kepala Biro Akademik, Kemahasiswaan dan Hubungan Masyarakat</span>
        <br><br>
        <br><br>
        <br>

        <span>Dra. Tri Suparmiyati, M.Si</span> <br>
        <span>NIP. 19670514 199303 2 001</span>
      </div>
    </section>
  </main>

  <footer>

  </footer>
</body>
</html>
