<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Telegram\BuilderCommand;
use App\Telegram\BuildKeyBoard;

class Telegram extends Controller
{
    public function onUpdate(Request $req) {

        if($req->isJson()) {
            $data = $req->json()->all();
            file_put_contents(base_path('logs.txt'), "===={Сообщение}====\r\n".json_encode($data, JSON_UNESCAPED_UNICODE)."\r\n", FILE_APPEND);


            $ch = curl_init("https://api.telegram.org/bot".env("TELEGRAM_BOT_ID").":".env("TELEGRAM_BOT_TOKEN")."/getMe");

            curl_setopt($ch, CURLOPT_POST, 1);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);

            //curl_setopt($ch, CURLOPT_PROXY, "sss:1080");
            //curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
            //curl_setopt($ch, CURLOPT_PROXYUSERPWD, "ss:ss");

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);

            curl_setopt($ch,CURLOPT_TIMEOUT, 0);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 0);


            $response = curl_exec($ch);

            echo curl_error($ch);

            curl_close($ch);

            var_dump($response);
        }

        $command = new BuilderCommand();
        $command->setCommand("sendPhoto");
        $command->appendArgument("chat_id", 322694502);
        $command->appendArgument("caption", "Hello world 2");
        $command->appendArgument("photo", "https://i.imgur.com/6dyEGiZ.jpg");

        $keyboard = new BuildKeyBoard();
        $keyboard->setInlineKeyBoard()
            ->appendRow()
            ->appendButtonInline("1 функция");

        $command->setKeyboard($keyboard);

        return response($command->buildCommand('res'), 200)
            ->header('content-type', 'application/json');

    }
}
