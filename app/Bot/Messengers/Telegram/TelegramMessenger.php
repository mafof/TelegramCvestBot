<?php


namespace App\Bot\Messengers\Telegram;

use App\Bot\Constants\CommandsList;
use App\Bot\Messengers\BaseMessenger;
use App\Bot\Messengers\Facades\TelegramStorage;
use App\Bot\Constants\Phrases;

use App\Bot\Messengers\Telegram\Builders\BuilderCommand;
use App\Bot\Messengers\Telegram\Builders\BuilderKeyBoard;
use App\Bot\Messengers\UserMessenger;

class TelegramMessenger implements BaseMessenger {

    public function commandMainMenu(UserMessenger $user) {
        // Добавить состояние пользователю...

        $command = new BuilderCommand;
        $command->setCommand("sendMessage");
        $command->appendArgument("chat_id", $user->identifier);
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

    public function commandStats(UserMessenger $user) {
        // Добавить состояние пользователю...

        $command = new BuilderCommand;
        $command->setCommand("sendMessage");
        $command->appendArgument("chat_id", $user->identifier);
        $command->appendArgument("text", sprintf(Phrases::STATS, "@{$user->nickName}", 0, 0));

        $keyboard = new BuilderKeyboard;
        $keyboard->setReplyKeyboard(true)
            ->appendRow()
            ->appendButtonReply(CommandsList::BACK);
        $command->setKeyboard($keyboard);

        return $command;
    }

    public function commandListQuests(UserMessenger $user) {
    }

    public function commandTopQuests(UserMessenger $user) {
    }

    public function commandProcessedQuest(UserMessenger $user) {
    }

    public function commandNotFound(UserMessenger $user) {
        $command = new BuilderCommand;
        $command->setCommand("sendMessage");
        $command->appendArgument("chat_id", $user->identifier);
        $command->appendArgument("text", Phrases::NOT_FOUND_COMMAND);

        return $command;
    }
}