<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Swift_Mailer;
use Swift_SmtpTransport;

class EmailConfig extends Model
{
    use HasFactory;
    public static function mymail()
    {
        if (Auth::check()) {
            $configuration = EmailConfig::where('user_id', Auth::user()->id)->first();
            if (!is_null($configuration)) {
                // set mailing configuration
                $transport = new Swift_SmtpTransport(
                    // $configuration->mail_from_address,
                    // $configuration->mail_from_name,
                    $configuration->mail_host,
                    $configuration->mail_port,
                    $configuration->mail_encryption
                );

                $transport->setUsername($configuration->mail_username);
                $transport->setPassword($configuration->mail_password);

                $maildoll = new Swift_Mailer($transport);

                // set mailtrap mailer
                Mail::setSwiftMailer($maildoll);
            }
        }
    }
}
