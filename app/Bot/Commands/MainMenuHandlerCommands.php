<?php


namespace App\Bot\Commands;

use App\Bot\Constants\CommandsList;
use App\Bot\Messengers\BaseMessenger;
use App\Bot\Messengers\UserMessenger;

class MainMenuHandlerCommands implements BaseHandlerCommands {


    public function handleCommand(UserMessenger $user, BaseMessenger $messenger) {
        $instCommand = false;

        switch($user->textMessage) {
            case CommandsList::START_BOT:
                $instCommand = $messenger->commandMainMenu($user);
            break;
            case CommandsList::GET_STATS:
                $instCommand = $messenger->commandStats($user);
            break;
            case CommandsList::ALL_QUESTS:
                $instCommand = false;
            break;
        }

        return $instCommand;
    }
}