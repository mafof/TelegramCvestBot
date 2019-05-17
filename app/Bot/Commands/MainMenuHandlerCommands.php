<?php


namespace App\Bot\Commands;

use App\Bot\Constants\CommandsList;
use App\Bot\Constants\LocationList;
use App\Bot\Messengers\BaseMessenger;
use App\Bot\Messengers\UserMessenger;

class MainMenuHandlerCommands extends BaseHandlerCommands {

    public function handleCommand(UserMessenger $user, BaseMessenger $messenger) {
        $storage = app()->make($this->getTypeMessenger($user));
        $instCommand = false;

        $storageUser = $storage->getUser($user->nickname);

        if($storageUser === false) {
            if($user->textMessage === CommandsList::START_BOT) {
                return $messenger->commandMainMenu($user);
            } else {

                if($messenger->recoverUser($user)) {
                    return $messenger->commandMainMenu($user);
                } else {
                    return $messenger->commandNotFound($user);
                }
            }
        }

        if(!$this->isType($storageUser)) return false;

        switch($user->textMessage) {
            case CommandsList::GET_STATS:
                $instCommand = $messenger->commandStats($user);
            break;
            case CommandsList::ALL_QUESTS:
                $instCommand = $messenger->commandListQuests($user);
            break;
        }

        return $instCommand;
    }

    protected function isType(Array $storageUser) {
        return ($storageUser['location'] === LocationList::MAIN_MENU);
    }
}