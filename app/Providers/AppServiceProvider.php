<?php

namespace App\Providers;

use App\Bot\Messengers\Telegram\TelegramStorageActionUsers;
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
        $this->app->singleton('telegramStorage', function () {
           return new TelegramStorageActionUsers();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
