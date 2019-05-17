<?php
/**
 * Интерфейс с необходимыми методами для вывода информации пользователю
 */
namespace App\Bot\Messengers;

interface BaseMessenger {
    // Базовые команды =>
    public function commandMainMenu(UserMessenger $user, bool $isPrev = true);
    public function commandStats(UserMessenger $user, bool $isPrev = true);
    public function commandTopUsers(UserMessenger $user, bool $isPrev = true);
    public function commandNotFound(UserMessenger $user);
    public function commandAcceptAccount(UserMessenger $user, bool $isPrev = true);
    public function commandBack(UserMessenger $user);
    public function createUser(UserMessenger $user);
    public function recoverUser(UserMessenger $user);
    // Команды квестов =>
    public function commandListQuests(UserMessenger $user, bool $isPrev = true);
    public function commandTopQuests(UserMessenger $user, bool $isPrev = true);
    public function commandNewQuests(UserMessenger $user, bool $isPrev = true);
    public function commandDescriptionQuest(UserMessenger $user, bool $isPrev = true);
    public function commandProcessedQuest(UserMessenger $user);
}