<?php


namespace App\Bot\Messengers\Facades;


use Illuminate\Support\Facades\Facade;

class TelegramStorage extends Facade {
    protected static function getFacadeAccessor() {
        return 'telegramStorage';
    }
}