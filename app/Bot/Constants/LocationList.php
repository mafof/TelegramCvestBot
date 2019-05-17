<?php
/**
 * Спиоск мест, где может находиться пользователь бота
 */
namespace App\Bot\Constants;

interface LocationList {
    const MAIN_MENU = 1;
    const ACCEPT_ACCOUNT = 3;

    const STATS = 2;
    const STATS_MY = 10;
    const STATS_TOP_USERS = 11;

    const QUESTS = 4;
    const QUESTS_TOP = 5;
    const QUESTS_NEW = 6;

    const QUEST_DESCRIBE = 7;
    const QUEST = 8;
    const QUEST_FINISH = 9;
}