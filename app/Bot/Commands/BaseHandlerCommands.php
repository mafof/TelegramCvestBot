<?php

namespace App\Bot\Commands;

use App\Bot\Messengers\BaseMessenger;

interface BaseHandlerCommands {
    const START_BOT = "/start";
    const ALL_QUESTS = "Список квестов";
    const GET_STATS = "Статистика";
    const BACK = "Вернуться назад";

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