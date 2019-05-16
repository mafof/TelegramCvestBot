<?php
/**
 * Спиоск мест, где может находиться пользователь бота
 */
namespace App\Bot\Constants;

interface LocationList {
    const MAIN_MENU = 1;
    const QUESTS = 2;
    const QUESTS_TOP = 3;
    const QUESTS_NEW = 4;
    const QUEST_DESCRIBE = 5;
    const QUEST = 6;
    const STATS = 7;
    const QUEST_FINISH = 8;
}