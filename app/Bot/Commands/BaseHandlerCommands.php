<?php

namespace App\Bot\Commands;

use App\Bot\Messengers\BaseMessenger;

interface BaseHandlerCommands {
    /**
     * Функция обработчик команды
     * @param $type - тип сообщения
     * @param $fromId - от кого(уникальный индетификатор пользователя от мессенджера)
     * @param $message - само сообщение
     * @param BaseMessenger $messenger - объект мессенджера
     * @return mixed - BuilderCommand класс заполненный командой | false
     */
    public function handleCommand($type, $fromId, $message, BaseMessenger $messenger);
}