<?php

namespace App\Mail;

use App\Models\PengajuanCuti;
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

    public $pengajuanCuti;

    public function __construct(array $pengajuanCuti)
    {
      $this->pengajuanCuti = $pengajuanCuti;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->subject('Pengajuan cuti berhasil diajukan, silahkan konfirmasi ke pembimbing akademik!')->markdown('emails.email', ['pengajuan' => $this->pengajuanCuti]);
    }
}
