<?php


namespace App\Bot\Messengers\Telegram;

use App\Bot\Constants\CommandsList;
use App\Bot\Messengers\BaseMessenger;
use App\Bot\Messengers\Facades\TelegramStorage;
use App\Bot\Constants\Phrases;

use App\Bot\Messengers\Telegram\Builders\BuilderCommand;
use App\Bot\Messengers\Telegram\Builders\BuilderKeyBoard;

class TelegramMessenger implements BaseMessenger {

    public function commandMainMenu($user_id) {
        // Добавить состояние пользователю...

        $command = new BuilderCommand;
        $command->setCommand("sendMessage");
        $command->appendArgument("chat_id", $user_id);
        $command->appendArgument("text", Phrases::MAIN_MENU);

        $keyboard = new BuilderKeyboard;
        $keyboard->setReplyKeyboard(true)
            ->appendRow()
            ->appendButtonReply(CommandsList::ALL_QUESTS)
            ->appendRow()
            ->appendButtonReply(CommandsList::GET_STATS);
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
            ->appendButtonReply(CommandsList::BACK);
        $command->setKeyboard($keyboard);

        return $command;
    }

    public function commandListQuests($user_id) {
    }

    public function commandTopQuests() {
    }

    public function commandProcessedQuest() {
    }
}