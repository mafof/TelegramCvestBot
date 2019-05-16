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

    public function addUser($identifier) {
        return $this->mem->add($this->PREFIX."_{$identifier}", Array(
            "prevLocation"    => false,
            "location"        => false,
            "stepQuest"       => false,
            "pageQuests"      => false
        ));
    }

    public function getUser($identifier) {
        return $this->mem->get($this->PREFIX."_{$identifier}");
    }

    public function removeUser($identifier) {
        return $this->mem->delete($this->PREFIX."_{$identifier}");
    }

    public function setLocationUser($identifier, int $location) {
        $userData = $this->getUser($identifier);
        if($userData == false) return false;

        if(isset($userData["location"]))
            $userData = $this->setPrevLocationUser($userData, $userData["location"]);

        $userData["location"] = $location;
        return $this->mem->set($this->PREFIX."_{$identifier}", $userData);
    }

    public function setStepQuestUser($identifier, int $step) {
        $userData = $this->getUser($identifier);
        if($userData == false) return false;

        $userData["stepQuest"] = $step;
        return $this->mem->set($this->PREFIX."_{$identifier}", $userData);
    }

    public function setPageQuestsUser($identifier, int $page) {
        $userData = $this->getUser($identifier);
        if($userData == false) return false;

        $userData["pageQuests"] = $page;
        return $this->mem->set($this->PREFIX."_{$identifier}", $userData);
    }

    private function setPrevLocationUser(Array $userData, int $location) {
        $userData["prevLocation"] = $location;
        return $userData;
    }
}