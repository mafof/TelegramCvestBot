<?php
/**
 * Список типов сообщения
 */
namespace App\Bot\Constants;


interface TypesMessages {
    const MESSAGE = 1;
    const KEYBOARD_INLINE_MESSAGE = 2;
    const STICKER = 3;
    const IMAGE = 4;
    const VIDEO = 5;
    const AUDIO = 6;
    const VOICE = 7;
}