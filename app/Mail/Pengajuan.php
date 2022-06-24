<?php

namespace App\Mail;

use App\Models\PengajuanMhs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Pengajuan extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $pengajuanMhs;

    public function __construct(array $pengajuanMhs)
    {
      $this->pengajuanMhs = $pengajuanMhs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->subject('Pengajuan cuti berhasil diajukan, silahkan konfirmasi ke pembimbing akademik!')->markdown('emails.email', ['pengajuan' => $this->pengajuanMhs]);
    }
}
