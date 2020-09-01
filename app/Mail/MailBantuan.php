<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailBantuan extends Mailable
{
    use Queueable, SerializesModels;
    public $databantuan; 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($databantuan)
    {
        $this->databantuan = $databantuan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('bantuan.hafces@gmail.com')->subject('Tiket Bantuan Baru')->view('bantuan_email_template');
    }
}
