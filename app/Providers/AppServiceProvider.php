<?php

namespace App\Providers;

use App\Models\SmtpSetting;
use App\Services\ImageService;
// use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

use Config;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('ImageService' , function($app){
            return new ImageService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ( Schema::hasTable('smtp_settings') )
        {
            $smtp = SmtpSetting::first();

            if ( $smtp ){
                Config::set('mail' , [
                    'driver'        => $smtp->mailer ,
                    'host'          => $smtp->host ,
                    'port'          => $smtp->port ,
                    'username'      => $smtp->username ,
                    'password'      => $smtp->password ,
                    'encryption'    => $smtp->encryption ,
                    'from'          => [
                        'address'   => $smtp->from_address ,
                        'name'      => 'AdminHotel' ,
                        ],
                ]);
            }

        }



    }
}
