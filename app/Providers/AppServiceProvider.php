<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // customizing the verification mail view
    VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
       return (new MailMessage)
            ->subject('Verify Email Address')
             ->line('Click the button below to verify your email address.')
             ->action('Verify Email Address', $url);
            //we can add a view instead, like this: ->view('view name',['url'=>$url]);
    });

      Schema::defaultStringLength(191);
    }
}
