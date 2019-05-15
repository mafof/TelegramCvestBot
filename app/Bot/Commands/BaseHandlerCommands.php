<?php

namespace App\Bot\Commands;

use App\Bot\Messengers\BaseMessenger;
use App\Bot\Messengers\UserMessenger;

interface BaseHandlerCommands {
    /**
     * Функция обработчик команды
     * @param UserMessenger $user - объект хранящий необходимые данные пользователя
     * @param BaseMessenger $messenger - объект мессенджера
     * @return mixed - BuilderCommand класс заполненный командой | false
     */
    public function handleCommand(UserMessenger $user, BaseMessenger $messenger);
}