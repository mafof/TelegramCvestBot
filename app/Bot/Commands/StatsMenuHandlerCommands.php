<?php


namespace App\Bot\Commands;


use App\Bot\Constants\CommandsList;
use App\Bot\Constants\LocationList;
use App\Bot\Messengers\BaseMessenger;
use App\Bot\Messengers\UserMessenger;

class StatsMenuHandlerCommands extends BaseHandlerCommands {

    protected $location = LocationList::STATS;

    public function handleCommand(UserMessenger $user, BaseMessenger $messenger) {
        $storage = app()->make($this->getTypeMessenger($user));
        $instCommand = false;

        $storageUser = $storage->getUser($user->nickname);
        if($storageUser === false) return false;

        if(!$this->isLocation($storageUser)) return false;

        switch($user->textMessage) {
            case CommandsList::STATS_TOP_USERS:
                $instCommand = $messenger->commandTopUsers($user);
            break;
            case CommandsList::BACK:
                $instCommand = $messenger->commandBack($user);
            break;
        }

        return $instCommand;
    }
}