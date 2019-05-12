<?php


namespace App\Bot\Messengers\Telegram;


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
            ->appendButtonReply(Phrases::ALL_QUESTS)
            ->appendRow()
            ->appendButtonReply(Phrases::GET_STATS);
        $command->setKeyboard($keyboard);

        return $command;
    }

    public function commandStats($user_id) {
        // Добавить состояние пользователю...

        $command = new BuilderCommand;
        $command->setCommand("sendMessage");
        $command->appendArgument("chat_id", $user_id);
        $command->appendArgument("text", Phrases::MAIN_MENU);

        $keyboard = new BuilderKeyboard;
        $keyboard->setReplyKeyboard(true)
            ->appendRow()
            ->appendButtonReply(Phrases::BACK);
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