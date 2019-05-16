<?php
/**
 * Главный класс работы с модулем
 */

namespace App\Bot\Messengers\Telegram;


use App\Bot\Constants\TypesMessages;
use App\Bot\Constants\TypesMessengers;
use App\Bot\Messengers\Telegram\Builders\BuilderCommand;
use App\Bot\Messengers\Telegram\Errors\ErrorCoreTelegram;
use App\Bot\Messengers\UserMessenger;

class Telegram {
    private $readyCommand = null;
    private $config = null;

    /**
     * Telegram constructor.
     * @param string $typeSend - тип отправки, `res` - в ответ на действие пользователя, `cURL` - с помощью модуля cURL
     */
    public function __construct($typeSend = 'res') {
        $this->config = new \stdClass();
        $this->config->typeSend = $typeSend;
    }

    public function setCommand(BuilderCommand $command) {
        $this->readyCommand = $command->buildCommand($this->config->typeSend);
    }

    public function sendCommand() {
        if(is_null($this->readyCommand)) throw new ErrorCoreTelegram("command is not defined");

        if($this->config->typeSend == 'response' || $this->config->typeSend == 'res') {

            return response($this->readyCommand, 200)
                ->header('content-type', 'application/json');

        } else if($this->config->typeSend == 'curl' || $this->config->typeSend == 'cURL'){

            // code...
            return response("ok", 200);

        } else {
            throw new ErrorCoreTelegram("type {$this->config->typeSend} is not defined");
        }
    }

    public function mainHandlerCommand($instResponse) {

        $userMessage = $this->getUserMessengerObject($instResponse);
        $handlerList = $this->getHandlerClassesName();

        // Делаем обход классов из выше указанного пространва имен =>
        foreach ($handlerList as $handleName) {
            $handle = new $handleName;
            $finishObject = $handle->handleCommand($userMessage, (new TelegramMessenger));

            if($finishObject != false && $finishObject instanceof BuilderCommand) {
                $this->setCommand($finishObject);
                break;
            }
        }

        // Если неизвестная команда =>
        if($this->readyCommand === null) {
            $this->setCommand((new TelegramMessenger())->commandNotFound($userMessage));
        }
    }

    private function getUserMessengerObject($instResponse) {
        $user = new UserMessenger;
        $user->typeMessage = $this->getTypeMessage($instResponse);
        $user->typeMessenger = TypesMessengers::TELEGRAM;

        if($user->typeMessage === TypesMessages::KEYBOARD_INLINE_MESSAGE) {

            $user->nickname = $instResponse->callback_query->message->chat->username;
            $user->identifier = $instResponse->callback_query->message->chat->id;
            $user->textMessage = $instResponse->callback_query->message->text;
            $user->commandText = $instResponse->callback_query->data;
        } else if($user->typeMessage === TypesMessages::MESSAGE) {

            $user->nickname = $instResponse->message->chat->username;
            $user->identifier = $instResponse->message->chat->id;
            $user->textMessage = $instResponse->message->text;
        } else {
            throw new ErrorCoreTelegram("Object is not current type");
        }

        return $user;
    }

    private function getTypeMessage($instResponse) {
        if(isset($instResponse->callback_query))
            return TypesMessages::KEYBOARD_INLINE_MESSAGE;
        else if(isset($instResponse->message->text))
            return TypesMessages::MESSAGE;
        else if(isset($instResponse->message->sticker))
            return TypesMessages::STICKER;
        else if(isset($instResponse->message->voice))
            return TypesMessages::VOICE;
        else
            return false;
    }

    private function getHandlerClassesName() {
        $composer = require(base_path('vendor/autoload.php'));
        $classFinder = new \Gears\ClassFinder($composer);
        return $classFinder->namespace("App\\Bot\\Commands")->search();
    }
}