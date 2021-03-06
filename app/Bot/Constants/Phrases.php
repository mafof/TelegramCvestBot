<?php
/**
 * Заготовленные фразы
 */

namespace App\Bot\Constants;


interface Phrases {
    const MAIN_MENU = "
Главное меню.
Для продолжения, вы можете авторизоваться, либо начать играть без авторизации, но в таком случае вы не сможете:
- Создавать квесты
- Вести статистику
";
    const STATS = "
Статистика игрока %s
Всего квестов отыграно: %d
Создано квестов: %d
";
    const ACCEPT_ACCOUNT = "
Для подтверждения аккаунта вы должны зарегестрироваться на сайте
%s
После регистрации зайдите в свой профиль и добавьте аккаунт в список аккаунтов воспользовавшись этим одноразовым ключом:
%s
(НИКОМУ НЕ ГОВОРИТЕ ЭТОТ ЕДИНОРАЗОВЫЙ КЛЮЧ, ВКЛЮЧАЯ АДМИНИСТРАЦИИ ПРОЕКТА) 
";
    const ALL_QUESTS = "Список квестов.";
    const STATS_TOP_USERS = "Топ игроков:\n%s";
    const NOT_FOUND_COMMAND = "Неизвестная команда";
}