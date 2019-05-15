<?php


namespace App\Bot\Commands;

use App\Bot\Constants\CommandsList;
use App\Bot\Messengers\BaseMessenger;

class MainMenuHandlerCommands implements BaseHandlerCommands {

    public function handleCommand($type, $fromId, $message, BaseMessenger $messenger) {
        if(!$this->isCurrentType($type)) return false;
        $instCommand = false;

        switch($message) {
            case CommandsList::START_BOT:
                $instCommand = $messenger->commandMainMenu($fromId);
            break;
            case CommandsList::GET_STATS:
                $instCommand = $messenger->commandStats($fromId);
            break;
            case CommandsList::ALL_QUESTS:
                $instCommand = false;
            break;
        }

        return $instCommand;
    }

    /**
     * @deprecated
     */
    private function isCurrentType($type) {
        return ($type == "message");
    }
}