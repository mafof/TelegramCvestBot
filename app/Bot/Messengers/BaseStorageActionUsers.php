<?php
/**
 * Базовый класс управления временными данными пользователя
 */
namespace App\Bot\Messengers;

class BaseStorageActionUsers {
    protected $PREFIX = null;
    protected $mem = null;

    public function __construct() {
        $this->mem = new \Memcache();
        $this->mem->connect('localhost', 11211);
    }

    public function addUser($nickname) {
        return $this->mem->add($this->PREFIX."_{$nickname}", Array(
            "prevLocation"    => false,
            "location"        => false,
            "stepQuest"       => false,
            "pageQuests"      => false
        ));
    }

    public function getUser($nickname) {
        return $this->mem->get($this->PREFIX."_{$nickname}");
    }

    public function removeUser($nickname) {
        return $this->mem->delete($this->PREFIX."_{$nickname}");
    }

    public function setLocationUser($nickname, int $location) {
        $userData = $this->getUser($nickname);
        if($userData == false) return false;

        if(isset($userData["location"]))
            $userData = $this->setPrevLocationUser($userData, $userData["location"]);

        $userData["location"] = $location;
        return $this->mem->set($this->PREFIX."_{$nickname}", $userData);
    }

    public function setStepQuestUser($nickname, int $step) {
        $userData = $this->getUser($nickname);
        if($userData == false) return false;

        $userData["stepQuest"] = $step;
        return $this->mem->set($this->PREFIX."_{$nickname}", $userData);
    }

    public function setPageQuestsUser($nickname, int $page) {
        $userData = $this->getUser($nickname);
        if($userData == false) return false;

        $userData["pageQuests"] = $page;
        return $this->mem->set($this->PREFIX."_{$nickname}", $userData);
    }

    private function setPrevLocationUser(Array $userData, int $location) {
        $userData["prevLocation"] = $location;
        return $userData;
    }
}