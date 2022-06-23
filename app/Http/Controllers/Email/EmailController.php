<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Pengajuan;

class EmailController extends Controller
{
  public function sendEmail ()
  {
    Mail::to('muklasnurardiansyah@gmail.com')->send(new Pengajuan());
    return 'Email Sent';
  }
}
