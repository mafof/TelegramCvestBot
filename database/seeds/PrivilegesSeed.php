<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivilegesSeed extends Seeder {

    public function run() {

        DB::table('privileges')->insert([
            'name' => "Управление аккаунтом",
            'description' => "Позволяет редактировать свой аккаунт"
        ]);

        DB::table('privileges')->insert([
            'name' => "Создание квеста",
            'description' => "Позволяет создавать/редактировать собственные квесты"
        ]);

        DB::table('privileges')->insert([
            'name' => "Управление квестами",
            'description' => "Позволяет создавать/редактировать/удалять/подтверждать любые квесты"
        ]);

        DB::table('privileges')->insert([
            'name' => "Управление аккаунтами",
            'description' => "Позволяет управлять аккаунтами всех пользователей (создавать/редактировать/банить/назначать роли)"
        ]);
    }
}
