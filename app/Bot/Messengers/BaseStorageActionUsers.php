<?php
/**
 * Базовый класс управления временными данными пользователя
 */
namespace App\Bot\Messengers;


class BaseStorageActionUsers {
    const LOCATION_MAIN_MENU = 1;
    const LOCATION_QUEST = 2;
    const LOCATION_STATS = 3;

    protected $PREFIX = null;
    protected $mem = null;

    public function __construct() {
        $this->mem = new \Memcache();
        $this->mem->connect('localhost', 11211);
    }

    public function addUser($nickname) {
        return $this->mem->add($this->PREFIX."_{$nickname}", Array(
            "location"        => false,
            "stepQuest"       => false,
            "isAcceptProfile" => false
        ));
    }

    public function getUser($nickname) {
        return $this->mem->get($this->PREFIX."_{$nickname}");
    }

    public function removeUser($nickname) {
        return $this->mem->delete($this->PREFIX."_{$nickname}");
    }

    public function setLocationUser($nickname, $location) {
        $userData = $this->getUser($nickname);
        if($userData == false) return false;

        $userData["location"] = $location;
        return $this->mem->set($this->PREFIX."_{$nickname}", $userData);
    }

    public function setStepQuestUser($nickname, $step) {
        $userData = $this->getUser($nickname);
        if($userData == false) return false;

        $userData["stepQuest"] = $step;
        return $this->mem->set($this->PREFIX."_{$nickname}", $userData);
    }
}