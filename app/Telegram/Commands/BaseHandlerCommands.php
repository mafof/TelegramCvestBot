<?php


namespace App\Telegram\Commands;


use App\Telegram\Builders\BuilderCommand;

interface BaseHandlerCommands {
    /**
     * функция обработчик команды
     * @param $type - тип сообщения
     * @param $message - объект сообщения
     * @return BuilderCommand - класс заполненный командой
     */
    public function handleCommand($type, $message);
}