<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            $introLines = ['We got this e-mail address when registering a new user at KTU LINKed.',
                'Because we care about security, we\'d like you to verify this e-mail for that account.',
                'If you did not create an account on KTU LINKed, ignore this e-mail'];
            return (new MailMessage)
                ->subject('Welcome! Verify your email!')
                ->from('ktulinked@gmail.com', 'KTU LINKed')
                ->markdown('vendor.notifications.email', ['actionUrl' => $url, 'actionText' => 'Verify your e-mail', 'introLines' => $introLines]);
        });
    }
}
