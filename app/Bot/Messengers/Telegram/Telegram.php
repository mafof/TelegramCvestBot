<?php
/**
 * Главный класс работы с модулем
 */

namespace App\Bot\Messengers\Telegram;


use App\Bot\Commands\MainMenuHandlerCommands;
use App\Bot\Messengers\Telegram\Builders\BuilderCommand;
use App\Bot\Messengers\Telegram\Errors\ErrorCoreTelegram;

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
            return response("1", 200);

        } else {
            throw new ErrorCoreTelegram("type {$this->config->typeSend} is not defined");
        }
    }

    public function mainHandlerCommand($objectResponse) {
        $typeMessage = $this->getTypeMessage($objectResponse);

        $composer = require(base_path('vendor/autoload.php'));
        $classFinder = new \Gears\ClassFinder($composer);
        $handlerList = $classFinder->namespace("App\\Bot\\Commands")->search();

        // Делаем обход классов из выше указанного пространва имен =>
        foreach ($handlerList as $handleName) {
            if($handleName == "NotFoundHandlerCommands") continue;

            $handle = new $handleName;
            $finishObject = $handle->handleCommand($typeMessage, $objectResponse->message, (new TelegramMessenger));

            if($finishObject != false && $finishObject instanceof BuilderCommand) {
                $this->setCommand($finishObject);
                break;
            }
        }

        // Если неизвестная команда =>
        // code...
    }

    private function getTypeMessage($objectResponse) {
        if(!isset($objectResponse->message)) throw new ErrorCoreTelegram("Object not valid");

        if(isset($objectResponse->message->text)) return "message";
        else if(isset($objectResponse->message->sticker)) return "sticker";
        else if(isset($objectResponse->message->voice)) return "voice";
        else return false;

    }
}