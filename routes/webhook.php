<?php

use Illuminate\Http\Request;

Route::any('/telegram/wh', 'App\Http\Controllers\Telegram@onUpdate');

Route::any('/vk/wh', function(Request $req) {
    file_put_contents(base_path("vk.txt"), json_encode($req->json()->all(), JSON_UNESCAPED_UNICODE), FILE_APPEND);
    return response('2340d7ee', 200);
});