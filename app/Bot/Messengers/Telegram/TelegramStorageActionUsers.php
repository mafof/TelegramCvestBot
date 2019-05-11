<?php


namespace App\Bot\Messengers\Telegram;


use App\Bot\Messengers\BaseStorageActionUsers;

class TelegramStorageActionUsers implements BaseStorageActionUsers {
    private const PREFIX = "tg";
    private $mem = null;

    public function __construct() {
        $this->mem = new \Memcache();
        $this->mem->connect('localhost', 11211);
    }

    public function addUser($nickname) {
        return $this->mem->add(self::PREFIX."_{$nickname}", Array(
            "location"  => false,
            "stepQuest" => false
        ));
    }

    public function getUser($nickname) {
        return $this->mem->get(self::PREFIX."_{$nickname}");
    }

    public function setLocationUser($nickname, $location) {
        $userData = $this->getUser($nickname);
        if($userData == false) return false;

        $userData["location"] = $location;
        return $this->mem->set(self::PREFIX."_{$nickname}", $userData);
    }

    public function setStepQuestUser($nickname, $step) {
        $userData = $this->getUser($nickname);
        if($userData == false) return false;

        $userData["stepQuest"] = $step;
        return $this->mem->set(self::PREFIX."_{$nickname}", $userData);
    }
}