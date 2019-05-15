<?php

namespace App\Bot\Commands;

use App\Bot\Constants\TypesMessengers;
use App\Bot\Messengers\BaseMessenger;
use App\Bot\Messengers\UserMessenger;

abstract class BaseHandlerCommands {
    /**
     * Функция обработчик команды
     * @param UserMessenger $user - объект хранящий необходимые данные пользователя
     * @param BaseMessenger $messenger - объект мессенджера
     * @return mixed - BuilderCommand класс заполненный командой | false
     */
    abstract public function handleCommand(UserMessenger $user, BaseMessenger $messenger);

    abstract protected function isType(Array $storageUser);

    /**
     * @param UserMessenger $user - объект хранящий необходимые данные пользователя
     * @return string - название класса для IOC контейнера
     */
    protected function getTypeMessenger(UserMessenger $user) {
        switch ($user->typeMessenger) {
            case TypesMessengers::TELEGRAM:
                return "telegramStorage";
            break;
            default:
                throw new \Error("Not found messenger {$user->typeMessenger}");
            break;
        }
    }
}