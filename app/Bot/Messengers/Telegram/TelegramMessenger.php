<?php

namespace App\Bot\Messengers\Telegram;

use App\Bot\Constants\CommandsList;
use App\Bot\Constants\LocationList;
use App\Bot\Constants\TypesMessengers;
use App\Bot\Messengers\BaseMessenger;
use App\Bot\Messengers\Facades\TelegramStorage;
use App\Bot\Constants\Phrases;

use App\Bot\Messengers\Telegram\Builders\BuilderCommand;
use App\Bot\Messengers\Telegram\Builders\BuilderKeyBoard;
use App\Bot\Messengers\Telegram\Errors\ErrorCoreTelegram;
use App\Bot\Messengers\UserMessenger;
use App\MessengersUser;
use Illuminate\Support\Str;

class TelegramMessenger implements BaseMessenger {

    public function commandMainMenu(UserMessenger $user, bool $isPrev = true) {
        $this->createUser($user);
        TelegramStorage::setLocationUser($user->nickname, LocationList::MAIN_MENU, $isPrev);

        $command = new BuilderCommand;
        $command->setCommand("sendMessage");
        $command->appendArgument("chat_id", $user->identifier);
        $command->appendArgument("text", Phrases::MAIN_MENU);

        $keyboard = new BuilderKeyboard;
        $keyboard->setReplyKeyboard(true)
            ->appendRow()
            ->appendButtonReply(CommandsList::ALL_QUESTS)
            ->appendRow()
            ->appendButtonReply(CommandsList::GET_STATS)
            ->appendRow()
            ->appendButtonReply(CommandsList::ACCEPT_ACCOUNT);

        $command->setKeyboard($keyboard);

        return $command;
    }

    public function commandStats(UserMessenger $user, bool $isPrev = true) {
        TelegramStorage::setLocationUser($user->nickname, LocationList::STATS, $isPrev);

        $command = new BuilderCommand;
        $command->setCommand("sendMessage");
        $command->appendArgument("chat_id", $user->identifier);
        $command->appendArgument("text", sprintf(Phrases::STATS, "@{$user->nickname}", 0, 0));

        $keyboard = new BuilderKeyboard;
        $keyboard->setReplyKeyboard(true)
            ->appendRow()
            ->appendButtonReply(CommandsList::STATS_TOP_USERS)
            ->appendRow()
            ->appendButtonReply(CommandsList::BACK);
        $command->setKeyboard($keyboard);

        return $command;
    }

    public function commandTopUsers(UserMessenger $user, bool $isPrev = true) {
        TelegramStorage::setLocationUser($user->nickname, LocationList::STATS_TOP_USERS, $isPrev);

        $command = new BuilderCommand;
        $command->setCommand("sendMessage");
        $command->appendArgument("chat_id", $user->identifier);
        $command->appendArgument("text", sprintf(Phrases::STATS_TOP_USERS, "1.test\n2.test\n3.test"));

        $keyboard = new BuilderKeyBoard;
        $keyboard->setReplyKeyboard(true)
            ->appendRow()
            ->appendButtonReply(CommandsList::BACK);
        $command->setKeyboard($keyboard);

        return $command;
    }

    public function commandListQuests(UserMessenger $user, bool $isPrev = true) {
        TelegramStorage::setLocationUser($user->nickname, LocationList::QUESTS, $isPrev);

        $command = new BuilderCommand;
        $command->setCommand("sendMessage");
        $command->appendArgument("chat_id", $user->identifier);
        $command->appendArgument("text", Phrases::ALL_QUESTS);

        $keyboard = new BuilderKeyboard;
        $keyboard->setReplyKeyboard(true)
            ->appendRow()
            ->appendButtonReply(CommandsList::TOP_QUESTS)
            ->appendRow()
            ->appendButtonReply(CommandsList::NEW_QUESTS)
            ->appendRow()
            ->appendButtonReply(CommandsList::BACK);
        $command->setKeyboard($keyboard);

        return $command;
    }

    public function commandTopQuests(UserMessenger $user, bool $isPrev = true) {
        TelegramStorage::setLocationUser($user->nickname, LocationList::QUESTS_TOP, $isPrev);

        $command = new BuilderCommand;
        $command->setCommand("sendMessage");
        $command->appendArgument("chat_id", $user->identifier);
        $command->appendArgument("text", "ЗАГЛУШКА");

        $keyboard = new BuilderKeyboard;
        $keyboard->setReplyKeyboard(true)
            ->appendRow()
            ->appendButtonReply(CommandsList::BACK);
        $command->setKeyboard($keyboard);

        return $command;
    }

    public function commandNewQuests(UserMessenger $user, bool $isPrev = true) {
        TelegramStorage::setLocationUser($user->nickname, LocationList::QUESTS_NEW, $isPrev);

        $command = new BuilderCommand;
        $command->setCommand("sendMessage");
        $command->appendArgument("chat_id", $user->identifier);
        $command->appendArgument("text", "ЗАГЛУШКА");

        $keyboard = new BuilderKeyboard;
        $keyboard->setReplyKeyboard(true)
            ->appendRow()
            ->appendButtonReply(CommandsList::BACK);
        $command->setKeyboard($keyboard);

        return $command;
    }

    public function commandDescriptionQuest(UserMessenger $user, bool $isPrev = true) {}

    public function commandProcessedQuest(UserMessenger $user) {}

    public function commandNotFound(UserMessenger $user) {
        $command = new BuilderCommand;
        $command->setCommand("sendMessage");
        $command->appendArgument("chat_id", $user->identifier);
        $command->appendArgument("text", Phrases::NOT_FOUND_COMMAND);

        return $command;
    }

    public function commandAcceptAccount(UserMessenger $user, bool $isPrev = true) {
        TelegramStorage::setLocationUser($user->nickname, LocationList::ACCEPT_ACCOUNT, $isPrev);

        $command = new BuilderCommand;
        $command->setCommand("sendMessage");
        $command->appendArgument("chat_id", $user->identifier);
        $command->appendArgument("text", sprintf(Phrases::ACCEPT_ACCOUNT, env('APP_URL'), Str::random(10)));

        $keyboard = new BuilderKeyboard;
        $keyboard->setReplyKeyboard(true)
            ->appendRow()
            ->appendButtonReply(CommandsList::BACK);
        $command->setKeyboard($keyboard);

        return $command;
    }

    public function commandBack(UserMessenger $user) {
        $prevLocation = TelegramStorage::popLastPrevLocationUser($user->nickname);
        switch ($prevLocation) {
            case LocationList::MAIN_MENU:
                return $this->commandMainMenu($user, false);
            break;
            case LocationList::QUESTS:
                return $this->commandListQuests($user, false);
            break;
            case LocationList::QUESTS_TOP:
                return $this->commandTopQuests($user, false);
            break;
            case LocationList::QUESTS_NEW:
                return $this->commandNewQuests($user, false);
            break;
            case LocationList::STATS_TOP_USERS:
                return $this->commandTopUsers($user, false);
            break;
            case LocationList::STATS:
                return $this->commandStats($user, false);
            break;
            default:
                throw new ErrorCoreTelegram("not found value prevLocation ${$prevLocation}");
            break;
        }
    }

    /**
     * Создает пользователя
     * @param UserMessenger $user
     */
    public function createUser(UserMessenger $user) {
        $dbUser = MessengersUser::getUser($user->identifier);
        if($dbUser === null) {
            MessengersUser::create([
                'messenger_identifier' => $user->identifier,
                'messenger_nickname' => $user->nickname,
                'messenger_type' => TypesMessengers::TELEGRAM
            ]);
        }

        $storageUser = TelegramStorage::getUser($user->nickname);
        if($storageUser === false) {
            TelegramStorage::addUser($user->nickname);
        }
    }

    public function recoverUser(UserMessenger $user) {
        $dbUser = MessengersUser::getUser($user->identifier);
        if($dbUser === null) return false;

        return TelegramStorage::addUser($user->nickname);
    }
}