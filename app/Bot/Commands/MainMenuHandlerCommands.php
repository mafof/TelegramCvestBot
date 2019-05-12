<?php


namespace App\Bot\Commands;

use App\Bot\Messengers\BaseMessenger;
use App\Bot\Phrases;

class MainMenuHandlerCommands implements BaseHandlerCommands, Phrases {

    public function handleCommand($type, $fromId, $message, BaseMessenger $messenger) {
        if(!$this->isCurrentType($type)) return false;
        $instCommand = false;

        switch($message) {
            case Phrases::START_BOT:
                $instCommand = $messenger->commandMainMenu($fromId);
            break;
            case Phrases::GET_STATS:
                $instCommand = false;
            break;
            case Phrases::ALL_QUESTS:
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