<?php


namespace App\Bot\Commands;


use App\Bot\Constants\CommandsList;
use App\Bot\Constants\LocationList;
use App\Bot\Messengers\BaseMessenger;
use App\Bot\Messengers\UserMessenger;

class StatsMenuHandlerCommands extends BaseHandlerCommands {

    public function handleCommand(UserMessenger $user, BaseMessenger $messenger) {
        $storage = app()->make($this->getTypeMessenger($user));
        $instCommand = false;

        $storageUser = $storage->getUser($user->nickName);
        if($storageUser === false) return false;

        if(!$this->isType($storageUser)) return false;

        if($user->textMessage === CommandsList::BACK)
            $instCommand = $messenger->commandBack($user);

        return $instCommand;
    }

    protected function isType(array $storageUser) {
        return ($storageUser['location'] === LocationList::STATS);
    }
}