<?php


namespace App\Telegram\Commands;


use App\Telegram\Builders\BuilderCommand;
use App\Telegram\Phrases;

class NotFoundHandlerCommands implements BaseHandlerCommands, Phrases {

    public function handleCommand($type, $message) {
        if(!$this->isCurrentType($type)) return false;

        $instCommand = new BuilderCommand;
        $instCommand->setCommand("sendMessage");
        $instCommand->appendArgument("chat_id", $message->chat->id);
        $instCommand->appendArgument("text", self::NOT_FOUND_COMMAND);

        return $instCommand;
    }

    private function isCurrentType($type) {
        return ($type == "message");
    }
}