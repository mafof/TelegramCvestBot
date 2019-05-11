<?php


namespace App\Telegram\Commands;

use App\Telegram\Builders\BuilderCommand;
use App\Telegram\Builders\BuilderKeyBoard;
use App\Telegram\Phrases;

class MainMenuHandlerCommands implements BaseHandlerCommands, Phrases {
    public function handleCommand($type, $message) {
        if(!$this->isCurrentType($type)) return false;

        $instCommand = new BuilderCommand;
        $instCommand->setCommand("sendMessage");
        $instCommand->appendArgument("chat_id", $message->chat->id);
        $instKeyBoard = new BuilderKeyBoard;

        switch($message->text) {
            case self::START_BOT:
                $instCommand->appendArgument("text", "Главное меню");
                $instKeyBoard->setReplyKeyboard(true)
                    ->appendRow()
                    ->appendButtonReply(self::ALL_QUESTS)
                    ->appendRow()
                    ->appendButtonReply(self::GET_STATS);
                $instCommand->setKeyboard($instKeyBoard);
            break;
            case self::ALL_QUESTS:
                return false;
                // code...
            break;
            case self::GET_STATS:
                return false;
                // code...
            break;
            default:
                return false;
            break;
        }

        return $instCommand;
    }

    private function isCurrentType($type) {
        return ($type == "message");
    }
}