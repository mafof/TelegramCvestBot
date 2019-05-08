<?php

Route::any('/telegram/wh', 'App\Http\Controllers\Telegram@onUpdate');