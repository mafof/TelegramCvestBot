<?php
/**
 * Интерфейс для определения методов записи/чтения последних действий пользователя
 */
namespace App\Bot\Messengers;


interface BaseStorageActionUsers {
    const MAIN_MENU = 1;
    const QUEST = 2;
    const STATS = 3;

    public function addUser($nickname);
    public function getUser($nickname);

    public function setLocationUser($nickname, $location);
    public function setStepQuestUser($nickname, $step);
}