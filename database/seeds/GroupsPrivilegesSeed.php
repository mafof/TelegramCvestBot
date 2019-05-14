<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsPrivilegesSeed extends Seeder {

    public function run() {
        // Группа пользователь =>
        DB::table('groups_privileges')->insert([
            'group_id' =>
                DB::table('groups')->select('id')->where('name', 'Пользователь')->get()[0]->id,
            'privilege_id' =>
                DB::table('privileges')->select('id')->where('name', 'Управление аккаунтом')->get()[0]->id
        ]);

        // Группа писатель =>
        DB::table('groups_privileges')->insert([
            'group_id' =>
                DB::table('groups')->select('id')->where('name', 'Писатель')->get()[0]->id,
            'privilege_id' =>
                DB::table('privileges')->select('id')->where('name', 'Управление аккаунтом')->get()[0]->id
        ]);

        DB::table('groups_privileges')->insert([
            'group_id' =>
                DB::table('groups')->select('id')->where('name', 'Писатель')->get()[0]->id,
            'privilege_id' =>
                DB::table('privileges')->select('id')->where('name', 'Создание квеста')->get()[0]->id
        ]);

        // Группа Модератор =>
        DB::table('groups_privileges')->insert([
            'group_id' =>
                DB::table('groups')->select('id')->where('name', 'Модератор')->get()[0]->id,
            'privilege_id' =>
                DB::table('privileges')->select('id')->where('name', 'Управление аккаунтом')->get()[0]->id
        ]);

        DB::table('groups_privileges')->insert([
            'group_id' =>
                DB::table('groups')->select('id')->where('name', 'Модератор')->get()[0]->id,
            'privilege_id' =>
                DB::table('privileges')->select('id')->where('name', 'Создание квеста')->get()[0]->id
        ]);

        DB::table('groups_privileges')->insert([
            'group_id' =>
                DB::table('groups')->select('id')->where('name', 'Модератор')->get()[0]->id,
            'privilege_id' =>
                DB::table('privileges')->select('id')->where('name', 'Управление квестами')->get()[0]->id
        ]);

        // Группа Администратор =>
        DB::table('groups_privileges')->insert([
            'group_id' =>
                DB::table('groups')->select('id')->where('name', 'Администратор')->get()[0]->id,
            'privilege_id' =>
                DB::table('privileges')->select('id')->where('name', 'Управление аккаунтом')->get()[0]->id
        ]);

        DB::table('groups_privileges')->insert([
            'group_id' =>
                DB::table('groups')->select('id')->where('name', 'Администратор')->get()[0]->id,
            'privilege_id' =>
                DB::table('privileges')->select('id')->where('name', 'Создание квеста')->get()[0]->id
        ]);

        DB::table('groups_privileges')->insert([
            'group_id' =>
                DB::table('groups')->select('id')->where('name', 'Администратор')->get()[0]->id,
            'privilege_id' =>
                DB::table('privileges')->select('id')->where('name', 'Управление квестами')->get()[0]->id
        ]);

        DB::table('groups_privileges')->insert([
            'group_id' =>
                DB::table('groups')->select('id')->where('name', 'Администратор')->get()[0]->id,
            'privilege_id' =>
                DB::table('privileges')->select('id')->where('name', 'Управление аккаунтами')->get()[0]->id
        ]);
    }
}
