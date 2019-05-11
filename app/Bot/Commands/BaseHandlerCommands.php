<?php

namespace App\Bot\Commands;

use App\Bot\Messengers\BaseMessenger;

interface BaseHandlerCommands {
    /**
     * функция обработчик команды
     * @param $type - тип сообщения
     * @param $message - объект сообщения
     * @param $messenger - объект мессенджера
     * @return mixed - BuilderCommand класс заполненный командой | false
     */
    public function handleCommand($type, $message, BaseMessenger $messenger);
}