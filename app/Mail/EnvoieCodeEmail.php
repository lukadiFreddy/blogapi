<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnvoieCodeEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $otp;
    public $nomsUser;

    public function __construct($otp, $nomsUser)
    {
        $this->otp = $otp;
        $this->nomsUser = $nomsUser;
    }


    public function build()
    {
        return $this->view('emails.codeMail')->with([
            "otp" => $this->otp,
            "nomsUser" => $this->nomsUser,

        ])->subject('Confirmation email');
    }
}
