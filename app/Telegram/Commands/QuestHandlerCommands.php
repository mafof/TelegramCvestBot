<?php


namespace App\Telegram\Commands;


use App\Telegram\Builders\BuilderCommand;

class QuestHandlerCommands implements BaseHandlerCommands {
    public function handleCommand($type, $message) {
        return false;
    }
}