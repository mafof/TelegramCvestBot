<?php


namespace App\Bot\Messengers\Facades;


use Illuminate\Support\Facades\Facade;
use App\Bot\Constants\LocationList;

/**
 * @method static bool addUser(string $nickname)
 * @method static mixed getUser(string $nickname)
 * @method static bool removeUser(string $nickname)
 * @method static bool setPrevLocationUser(string $nickname, int $location)
 * @method static bool setLocationUser(string $nickname, int $location)
 * @method static bool setStepQuestUser(string $nickname, int $step)
 * @method static bool setPageQuestsUser(string $nickname, int $page)
 *
 * @see \App\Bot\Messengers\Telegram\TelegramStorageActionUsers
 * @see \App\Bot\Messengers\BaseStorageActionUsers
 */
class TelegramStorage extends Facade {
    protected static function getFacadeAccessor() {
        return 'telegramStorage';
    }
}