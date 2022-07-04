<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Surat Izin Cuti Kuliah_{{ $pengajuan->nama }}_{{ $pengajuan->nim }}</title>
  <style>
    .header {
      display: flex;
      flex-direction: row;
      text-align: center;
      justify-content: space-between;
      /* border: 1px solid blue;  */
      padding: 1rem 1rem;
      margin-bottom: 0;
      padding: 0;
    }

    h1, h2, h3, h4, h5, h6 {
      margin-bottom: 0;
      padding: 0;
      margin-top: 0;
    }

    .ttd {
      display: flex;
      flex-direction: column;
    }
  </style>
</head>
<body>
  <header style="" class="header">
    {{-- <div class="img" style="width: 50px; height: 100px; border: 1px solid black;">
      test
    </div> --}}
    <div class="kop_surat" style="flex:1;">
      <h3 style="margin-bottom: 0">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, <br> RISET DAN TEKNOLOGI</h3>
      <h3 style="margin-bottom: 0; margin-top:0; letter-spacing: 2;">UNIVERSITAS NEGERI JAKARTA</h3>
      <small>Kampus Universitas Negeri Jakarta, Jl. Rawamangun Muka, Jakarta 13220</small>
      <br>
      <small>Telp: Rektor: (021) 4893854, WR 1:  4895130, WR II: 4893918, WR III: 4892926, WR IV: 4893982</small>
      <br>
      <small> BUK: 4750930, BAKHUM: 4759081, 4893668, BK: 4752180, <br> Bag. UHTP: Telp. 4890046, Bag. Keuangan: 4892414 Bag. Kepegawaian: 4890536</small> <br>
      <small>Laman: www.unj.ac.id</small>
    </div>
    <hr style="margin-bottom:0; padding: 0">
  </header>
  <main>
    <section style="text-align: center;">
      <h2 style="text-transform: uppercase; text-decoration:underline;">surat izin cuti kuliah</h2>
      <h3>Nomor: {{ $pengajuan->no_surat_fakultas }}</h3>
    </section>

    <section class="content">
      <p style="text-align: justify;">Berdasarkan permohonan dari <span>{{ ($pengajuan->status_pengajuan >= 3) ? 'Wakil Dekan 1 ' . $pengajuan->nama_fakultas : '' }}</span> Nomor: <span>{{ $pengajuan->no_surat_fakultas }}</span> dan telah disetujui oleh <span>{{ ($pengajuan->status_pengajuan >= 4) ? 'Wakil Rektor Bidang Akademik UNJ' : '' }}</span> tanggal <span>{{ date('d M Y', strtotime(isset($history->created_at))) }}</span>, <span>{{ ($pengajuan->status_pengajuan >= 5) ? 'Kepala Biro Akademik, Kemahasiswaan dan Hubungan Masyarakat UNJ' : '' }}</span> memberikan izin <span>{{ ($pengajuan->jenis_pengajuan === 1) ? 'cuti kuliah' : 'pengunduran diri kuliah' }}</span> kepada mahasiswa atas nama:
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
        <tr>
          <td>Jenjang</td>
          <td>:</td>
          <td>{{ $pengajuan->jenjang }}</td>
        </tr>
        <tr>
          <td>Fakultas</td>
          <td>:</td>
          <td>{{ $pengajuan->nama_fakultas }}</td>
        </tr>
      </table>

      <p>Untuk cuti kuliah pada semester {{ ($periode->semester % 2 == 0) ? 'genap' : 'ganjil' }} {{ $periode->des_semester }} tahun Akademik {{ $periode->des_semester }}.</p>
    </section>

    <section class="closing">
      <p>Surat izin ini dibuat agar hak dan kewajibannya sebagai mahasiswa Universitas Negeri Jakarta pada semester {{ ($periode->semester % 2 == 0) ? 'genap' : 'ganjil' }} ({{ $periode->semester }}) dapat dipergunakan.</p>
      <p>Demikian surat keterangan ini diberikan untuk dapat dipergunakan sebagaimana mestinya.</p>
    </section>

    <br>
    <section class="ttd" style="overflow: auto;">
      <div style="width: 40%; float: right;">
        <span>Jakarta, {{ date('d M Y') }}</span>
        <br>
        <span>Kepala Biro Akademik, Kemahasiswaan dan Hubungan Masyarakat</span>
        <br><br>
        <br><br>
        <br>

        <span>Kamandoko, S.Sos</span> <br>
        <span>NIP.</span>
      </div>
    </section>
  </main>

  <footer>
    <div class="tembusan" style="margin-top: 14rem;">
      <ol>
        <span style="text-align: left">Tembusan:</span>
        <li>Wakil Dekan 1 {{ $pengajuan->nama_fakultas }}</li>
        <li>Koordinator Prodi {{ $pengajuan->nama_prodi }}</li>
        <li>Kepala UPT TIK</li>
        <li>Yang bersangkutan</li>
      </ol>
    </div>

    <div class="catatan">
      <small style="border: 1px solid black; padding: 2rem 0;">Note: Apabila tidak melakukan pembayaran sesuai dengan jadwal pembayaran, maka surat izin cuti ini dianggap <strong>BATAL</strong>.</small>
    </div>
  </footer>
</body>
</html>
