<?php
/**
 * Объект полностью описывающий пользователя мессенджера (работает как временный объект - на один запрос)
 */
namespace App\Bot\Messengers;


class UserMessenger {
    public $nickName;
    public $identifier;
    public $textMessage;
    public $typeMessage;
}