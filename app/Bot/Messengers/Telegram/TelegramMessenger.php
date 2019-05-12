<?php


namespace App\Bot\Messengers\Telegram;


use App\Bot\Commands\BaseHandlerCommands;
use App\Bot\Messengers\BaseMessenger;
use App\Bot\Phrases;

use App\Bot\Messengers\Telegram\Builders\BuilderCommand;
use App\Bot\Messengers\Telegram\Builders\BuilderKeyBoard;

class TelegramMessenger implements BaseMessenger, Phrases {

    public function commandMainMenu($user_id) {
        // Добавить состояние пользователю...

        $command = new BuilderCommand;
        $command->setCommand("sendMessage");
        $command->appendArgument("chat_id", $user_id);
        $command->appendArgument("text", Phrases::MAIN_MENU);

        $keyboard = new BuilderKeyboard;
        $keyboard->setReplyKeyboard(true)
            ->appendRow()
            ->appendButtonReply(BaseHandlerCommands::ALL_QUESTS)
            ->appendRow()
            ->appendButtonReply(BaseHandlerCommands::GET_STATS);
        $command->setKeyboard($keyboard);

        return $command;
    }

    public function commandStats($user_id) {
        // Добавить состояние пользователю...

        $command = new BuilderCommand;
        $command->setCommand("sendMessage");
        $command->appendArgument("chat_id", $user_id);
        $command->appendArgument("text", sprintf(Phrases::STATS, $user_id, 0, 0));

        $keyboard = new BuilderKeyboard;
        $keyboard->setReplyKeyboard(true)
            ->appendRow()
            ->appendButtonReply(BaseHandlerCommands::BACK);
        $command->setKeyboard($keyboard);

        return $command;
    }

    public function commandListQuests() {
    }

    public function commandTopQuests() {
    }

    public function commandProcessedQuest() {
    }
}