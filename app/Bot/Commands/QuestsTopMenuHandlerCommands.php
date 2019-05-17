<?php


namespace App\Bot\Commands;


use App\Bot\Constants\CommandsList;
use App\Bot\Constants\LocationList;
use App\Bot\Messengers\BaseMessenger;
use App\Bot\Messengers\UserMessenger;

class QuestsTopMenuHandlerCommands extends BaseHandlerCommands {

    protected $location = LocationList::QUESTS_TOP;

    public function handleCommand(UserMessenger $user, BaseMessenger $messenger) {
        $storage = app()->make($this->getTypeMessenger($user));
        $instCommand = false;

        $storageUser = $storage->getUser($user->nickname);

        if($storageUser === false) return false;

        if(!$this->isLocation($storageUser)) return false;

        switch($user->textMessage) {
            case CommandsList::BACK:
                $instCommand = $messenger->commandBack($user);
                break;
        }

        return $instCommand;
    }

}