<?php


namespace App\Bot\Commands;

use App\Bot\Messengers\BaseMessenger;
use App\Bot\Phrases;

class MainMenuHandlerCommands implements BaseHandlerCommands {

    public function handleCommand($type, $fromId, $message, BaseMessenger $messenger) {
        if(!$this->isCurrentType($type)) return false;
        $instCommand = false;

        switch($message) {
            case self::START_BOT:
                $instCommand = $messenger->commandMainMenu($fromId);
            break;
            case self::GET_STATS:
                $instCommand = $messenger->commandStats($fromId);
            break;
            case self::ALL_QUESTS:
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