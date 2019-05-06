<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsListUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Список всех групп для пользователей =>
        DB::table('groups_list_user')->insert([
            'name'                => 'Пользователь',
            'privilege_unique_id' => 1
        ]);

        DB::table('groups_list_user')->insert([
            'name'                => 'Автор',
            'privilege_unique_id' => 2
        ]);

        DB::table('groups_list_user')->insert([
            'name'                => 'Модератор',
            'privilege_unique_id' => 3
        ]);

        DB::table('groups_list_user')->insert([
            'name'                => 'Админ',
            'privilege_unique_id' => 4
        ]);
    }
}
