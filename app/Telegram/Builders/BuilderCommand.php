<?php
/**
 * Класс собирает команду в JSON представление/дескриптор cURL
 */

namespace App\Telegram\Builders;
use App\Telegram\Errors\ErrorBuilderCommand;

class BuilderCommand {
    private $command         = null;
    private $argsCommand     = Array();
    private $keyBoard        = null;

    public function setCommand($command) {
        $this->command = $command;
    }

    public function setKeyboard(BuilderKeyBoard $keyBoard) {
        $this->keyBoard = $keyBoard->getKeyboard();
    }

    public function appendArgument($key, $value) {
        $this->argsCommand[$key] = $value;
    }

    public function removeArgument($key) {
        unset($this->argsCommand[$key]);
    }

    public function buildCommand($type) {
        if($this->command == null || $this->argsCommand == null) {
            throw new ErrorBuilderCommand("is not set command or arguments to it");
        }

        $resultResponse = null;
        $resultResponse = $this->appendArguments($type);
        $resultResponse = $this->appendKeyboard($resultResponse, $type);

        if($type == 'response' || $type == 'res') {
            return json_encode($resultResponse);
        } else if($type == 'curl' || $type == 'cURL') {
            return $resultResponse;
        } else {
            throw new ErrorBuilderCommand("type is not found {$type}");
        }
    }

    /**
     * Добавляет аргументы в запрос
     * @param $type - тип отправки
     * @return mixed - возвращает объект в зависимости от типа
     */
    private function appendArguments($type) {

        if($type == 'response' || $type == 'res') {
            $resultResponse = new \stdClass();
            $resultResponse->method = $this->command;

            foreach ($this->argsCommand as $key => $value) {
                $resultResponse->$key = $value;
            }

            return $resultResponse;

        } else if($type == 'curl' || $type == 'cURL') {
            $resultResponse = curl_init("https://api.telegram.org/bot".env("").":".env("")."/{$this->command}");
            curl_setopt($resultResponse, CURLOPT_POST, true);
            curl_setopt($resultResponse, CURLOPT_POSTFIELDS, $this->argsCommand);

            return $resultResponse;

        } else {
            throw new ErrorBuilderCommand("type is not found {$type}");
        }
    }

    /**
     * Добавляет клавиатуру в запрос
     * @param $resultResponse - объект вставки
     * @param $type - тип отправки
     * @return mixed - возвращает объект в зависимости от типа
     */
    private function appendKeyboard($resultResponse, $type) {
        if($this->keyBoard == null) return $resultResponse;

        if($type == 'response' || $type == 'res') {
            $resultResponse->reply_markup = $this->keyBoard;
            return $resultResponse;

        } else if($type == 'curl' || $type == 'cURL') {
            $this->argsCommand->reply_markup = $this->keyBoard;
            curl_setopt($resultResponse, CURLOPT_POSTFIELDS, $this->argsCommand);
            return $resultResponse;

        } else {
            throw new ErrorBuilderCommand("type is not found {$type}");
        }
    }

}
