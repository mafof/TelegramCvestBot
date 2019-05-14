<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsPrivilegesSeed extends Seeder {

    public function run() {
        // Группа пользователь =>
        DB::table('group_privilege')->insert([
            'group_id' => App\Group::where('name', 'Пользователь')->first()->id,
            'privilege_id' => App\Privilege::where('name', 'Управление аккаунтом')->first()->id
        ]);

        // Группа писатель =>
        DB::table('group_privilege')->insert([
            'group_id' => App\Group::where('name', 'Писатель')->first()->id,
            'privilege_id' => App\Privilege::where('name', 'Управление аккаунтом')->first()->id
        ]);

        DB::table('group_privilege')->insert([
            'group_id' => App\Group::where('name', 'Писатель')->first()->id,
            'privilege_id' => App\Privilege::where('name', 'Создание квеста')->first()->id
        ]);

        // Группа Модератор =>
        DB::table('group_privilege')->insert([
            'group_id' => App\Group::where('name', 'Модератор')->first()->id,
            'privilege_id' => App\Privilege::where('name', 'Управление аккаунтом')->first()->id
        ]);

        DB::table('group_privilege')->insert([
            'group_id' => App\Group::where('name', 'Модератор')->first()->id,
            'privilege_id' => App\Privilege::where('name', 'Создание квеста')->first()->id
        ]);

        DB::table('group_privilege')->insert([
            'group_id' => App\Group::where('name', 'Модератор')->first()->id,
            'privilege_id' => App\Privilege::where('name', 'Управление квестами')->first()->id
        ]);

        // Группа Администратор =>
        DB::table('group_privilege')->insert([
            'group_id' => App\Group::where('name', 'Администратор')->first()->id,
            'privilege_id' => App\Privilege::where('name', 'Управление аккаунтом')->first()->id
        ]);

        DB::table('group_privilege')->insert([
            'group_id' => App\Group::where('name', 'Администратор')->first()->id,
            'privilege_id' => App\Privilege::where('name', 'Создание квеста')->first()->id
        ]);

        DB::table('group_privilege')->insert([
            'group_id' => App\Group::where('name', 'Администратор')->first()->id,
            'privilege_id' => App\Privilege::where('name', 'Управление квестами')->first()->id
        ]);

        DB::table('group_privilege')->insert([
            'group_id' => App\Group::where('name', 'Администратор')->first()->id,
            'privilege_id' => App\Privilege::where('name', 'Управление аккаунтами')->first()->id
        ]);
    }
}
