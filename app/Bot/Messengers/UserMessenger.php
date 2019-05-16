<?php
/**
 * Объект полностью описывающий пользователя мессенджера (работает как временный объект - на один запрос)
 */
namespace App\Bot\Messengers;


class UserMessenger {
    public $nickname;      // Условное имя пользователя
    public $identifier;    // индетификатор пользователя
    public $textMessage;   // Текст сообщения
    public $typeMessage;   // Тип сообщения
    public $typeMessenger; // Тип мессенджера
    public $commandText;   // Комманда от кнопки
}