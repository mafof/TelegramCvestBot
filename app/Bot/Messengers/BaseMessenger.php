<?php
/**
 * Интерфейс с необходимыми методами для вывода информации пользователю
 */
namespace App\Bot\Messengers;

interface BaseMessenger {
    // Базовые команды =>
    public function commandMainMenu(UserMessenger $user);
    public function commandStats(UserMessenger $user);
    public function commandNotFound(UserMessenger $user);
    public function commandAcceptAccount(UserMessenger $user);
    public function commandBack(UserMessenger $user);
    public function createUser(UserMessenger $user);
    public function recoverUser(UserMessenger $user);
    // Команды квестов =>
    public function commandListQuests(UserMessenger $user);
    public function commandTopQuests(UserMessenger $user);
    public function commandNewQuests(UserMessenger $user);
    public function commandProcessedQuest(UserMessenger $user);
}