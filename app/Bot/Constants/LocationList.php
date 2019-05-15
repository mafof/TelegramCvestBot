<?php
/**
 * Спиоск мест, где может находиться пользователь бота
 */
namespace App\Bot\Constants;

interface LocationList {
    const MAIN_MENU = 1;
    const QUEST = 2;
    const STATS = 3;
}