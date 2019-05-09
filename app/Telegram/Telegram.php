<?php
/**
 * Главный класс работы с модулем
 */

namespace App\Telegram;


use App\Telegram\Builders\BuilderCommand;
use App\Telegram\Errors\ErrorCoreTelegram;

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
}