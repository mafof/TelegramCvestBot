<?php
/**
 * Интерфейс с необходимыми методами для вывода информации пользователю
 */
namespace App\Bot\Messengers;

interface BaseMessenger {
    public function commandMainMenu(UserMessenger $user);
    public function commandStats(UserMessenger $user);
    public function commandNotFound(UserMessenger $user);

    public function commandListQuests(UserMessenger $user);
    public function commandTopQuests(UserMessenger $user);

    public function commandProcessedQuest(UserMessenger $user);
}