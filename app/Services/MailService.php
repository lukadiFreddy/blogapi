<?php

namespace App\Services;

use App\Mail\EnvoieCodeEmail;
use Illuminate\Support\Facades\Mail;

class MailService
{

   public function sendMailVerification($mail, $user, $otp)
   {

      Mail::to($mail)->send(new EnvoieCodeEmail($otp, $user));
   }
}
