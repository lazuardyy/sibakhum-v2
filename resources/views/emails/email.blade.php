@component('mail::message')
Halo {{ $pengajuan[0]->nama }}, pengajuan {{ ($pengajuan[0]->jenis_pengajuan == '1') ? 'cuti' : 'pengunduran diri' }} kamu berhasil diajukan. Silahkan konfirmasi ke pembimbing akademik kamu ya ^^

Thanks, <br>
{{ config('app.name') }}
@endcomponent
