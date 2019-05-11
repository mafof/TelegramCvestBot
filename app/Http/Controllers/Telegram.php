<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Telegram\Builders\BuilderCommand;
use App\Telegram\Builders\BuilderKeyBoard;
use App\Telegram\Telegram as TelegramCore;

class Telegram extends Controller
{
    public function onUpdate(Request $req) {

        if($req->isJson()) {
            $data = $req->json()->all();
            file_put_contents(base_path('logs.txt'), "===={Сообщение}====\r\n".json_encode($data, JSON_UNESCAPED_UNICODE)."\r\n", FILE_APPEND);

            $data = json_decode(json_encode($data), false);

            $tg = new TelegramCore();
            $tg->mainHandlerCommand($data);

            return $tg->sendCommand();
        }

    }
}
