<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\EmailConfig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Mail\Mailer;
use Swift_Mailer;
use Swift_SmtpTransport;
class MailConfigProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // get email view data in provider class
        // view()->composer('email', function ($view) {

            if(isset(Auth::user()->id)) {

                $configuration =  EmailConfig::where('user_id',Auth::user()->id)->first();
                if(!is_null($configuration)) {
                    $config = array(
                        'driver'     =>     $configuration->mail_driver,
                        'host'       =>     $configuration->mail_host,
                        'port'       =>     $configuration->mail_port,
                        'username'   =>     $configuration->mail_username,
                        'password'   =>     $configuration->mail_password,
                        'encryption' =>     $configuration->mail_encryption,
                        'from'       =>     array('address' => $configuration->mail_from_address, 'name' => $configuration->mail_from_name),
                    );
                    Config::set('mail', $config);
                    $app = App::getInstance();
                    $app->register('Illuminate\Mail\MailServiceProvider');
                }
            }
        // });
    }
}
