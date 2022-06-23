@component('mail::message')
Halo {{ $pengajuan[0]->nama }}, pengajuan cuti kamu berhasil diajukan. Silahkan konfirmasi ke pembimbing akademik kamu ya ^^

Thanks, <br>
{{ config('app.name') }}
@endcomponent
