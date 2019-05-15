<?php
/**
 * Интерфейс с необходимыми методами для вывода информации пользователю
 */
namespace App\Bot\Messengers;


interface BaseMessenger {
    public function commandMainMenu($user_id);
    public function commandStats($user_id);

    public function commandListQuests($user_id);
    public function commandTopQuests();

    public function commandProcessedQuest();
}