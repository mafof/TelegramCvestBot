<?php


namespace App\Bot\Messengers\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @method static bool addUser(string $identifier)
 * @method static mixed getUser(string $identifier)
 * @method static bool removeUser(string $identifier)
 * @method static bool setLocationUser(string $identifier, int $location, bool $isPrev)
 * @method static bool setStepQuestUser(string $identifier, int $step)
 * @method static bool setPageQuestsUser(string $identifier, int $page)
 * @method static int popLastPrevLocationUser(string $identifier)
 * @see \App\Bot\Messengers\Telegram\TelegramStorageActionUsers
 * @see \App\Bot\Messengers\BaseStorageActionUsers
 */
class TelegramStorage extends Facade {
    protected static function getFacadeAccessor() {
        return 'telegramStorage';
    }
}