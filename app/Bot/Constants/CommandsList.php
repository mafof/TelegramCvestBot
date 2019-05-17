<?php
/**
 * Список комманд
 */
namespace App\Bot\Constants;


interface CommandsList {
    const START_BOT = "/start";
    const ALL_QUESTS = "Список квестов";
    const NEW_QUESTS = "Список новых квестов";
    const TOP_QUESTS = "Список топ квестов";
    const GET_STATS = "Статистика";
    const ACCEPT_ACCOUNT = "Подтвердить аккаунт";
    const BACK = "Назад";
}