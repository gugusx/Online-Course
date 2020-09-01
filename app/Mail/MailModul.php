<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailModul extends Mailable
{
    use Queueable, SerializesModels;

     public $tran;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tran)
    {
        $this->tran = $tran;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from('noreplyhafces@gmail.com')
                    ->subject('Konfirmasi Pembelian Kursus')
                    ->view('mailmodul');
    }
}
