<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Surat Permohonan Pengunduran Diri_{{ $pengajuan->nama }}_{{ $pengajuan->nim }}</title>
  <style>
    h1, h2, h3, h4, h5, h6 {
      /* margin-bottom: 0; */
      padding: 0;
      margin: 0;
      /* margin-top: 0; */
    }

    .kop_surat{
      /* padding: 1rem; */
    }

    h3 {
      text-transform: uppercase;
      /* border: 1px solid red; */
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
  </style>
</head>
<body>
  <header class="header">
    <table>
      <tr>
        <td><img src="assets/img/unj.png" alt="logo"></td>
        <td>
          <div class="kop_surat" style="text-align: center;">
            <h3>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, <br> RISET DAN TEKNOLOGI</h3>
            <h3 style="letter-spacing: 2;">UNIVERSITAS NEGERI JAKARTA</h3>
            <h3 style="letter-spacing: 2;">{{ $fakultas->namaFakultas }}</h3>

            <small>{{ $fakultas->lokasiFakultas }}, {{ $fakultas->onlineFakultas }}</small>
          </div>
        </td>
      </tr>
    </table>
    <hr>
  </header>

  <main>
    <section>
      <table style="width: 100%;">
        <tr>
          <td>Nomor</td>
          <td>: {{ $pengajuan->ref_surat->no_surat_fakultas }}</td>
          <td colspan="3" style="text-align: right">{{ date('d M Y') }}</td>
        </tr>
        <tr>
          <td>Lamp</td>
          <td>: 1 Berkas</td>
        </tr>
        <tr>
          <td>Hal</td>
          <td>: Permohonan Pengunduran Diri</td>
        </tr>
      </table>
    </section>

    <section class="ditujukan_kepada">
      <p>Kepada Yth. <br> Wakil Rektor Bidang Akademik <br> Universitas Negeri Jakarta</p>
    </section>

    <section class="content">
      <p>
        Menindaklanjuti surat Koorprodi {{ $pengajuan->nama_prodi }}, nomor {{ $pengajuan->ref_surat->no_surat_prodi }}, tanggal {{ date('d M Y'), strtotime($pengajuan->created_at) }} {{ $pengajuan->nama_fakultas }}, tentang pengajuan permohonan Pengunduran Diri, atas nama:
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
          <td>Program Studi</td>
          <td>:</td>
          <td>{{ $pengajuan->nama_prodi }}</td>
        </tr>
      </table>

      <div class="keterangan">
        <p>Mahasiswa tersebut mengajukan pengunduran diri pada semester {{ ($periode->semester % 2 == 0) ? 'Genap' : 'Ganjil' }} tahun akademik {{ $periode->des_semester }}, dikarenakan {{ $pengajuan->keterangan }}. Untuk itu mohon kiranya diberikan surat keterangan pernah kuliah dan nilai akademik kepada mahasiswa yang bersangkutan.</p>
      </div>
    </section>

    <section class="closing">
      <p>Demikian permohonan ini disampaikan. Atas perhatian dan bantuannya kami ucapkan terimakasih.</p>
    </section>
  </main>

  <section class="ttd" style="overflow: auto; padding-top: 3rem">
    <div style="width: 40%; float: right;">
      <span>Jakarta, {{ date('d M Y') }}</span>
      <br>
      <span>Wakil Dekan Bidang Akademik</span>
      <br><br>
      <br><br>
      <br>

      <span>{{ $dosen->namaGelar }}</span> <br>
      <span>NIP. {{ $dosen->nip }}</span>
    </div>
  </section>

  <footer>
    <div class="tembusan" style="margin-top: 14rem;">
      <span style="text-align: left; margin: 0; padding: 1rem;">Tembusan:</span>
      <ol style="margin: 0;">
        <li>Dekan</li>
        <li>Ka. Bakhum</li>
        <li>Ka. TIK</li>
        <li>Koordinator Layanan Akademik BAKHUM</li>
        <li>Koorprodi {{ $pengajuan->nama_prodi }}</li>
        <li>Ybs (Mahasiswa)</li>
      </ol>
    </div>
  </footer>
</body>
</html>
