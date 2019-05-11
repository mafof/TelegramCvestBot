<?php
/**
 * Интерфейс с заготовленными фразами
 */

namespace App\Telegram;


interface Phrases {
    const START_BOT = "/start";
    const ALL_QUESTS = "Все квесты";
    const GET_STATS = "Статистика";

    const NOT_FOUND_COMMAND = "Неизвестная команда";
}