<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsSeed extends Seeder {

    public function run() {
        DB::table('groups')->insert([
            'name' => "Пользователь"
        ]);

        DB::table('groups')->insert([
            'name' => "Писатель"
        ]);

        DB::table('groups')->insert([
            'name' => "Модератор"
        ]);

        DB::table('groups')->insert([
            'name' => "Администратор"
        ]);
    }
}
