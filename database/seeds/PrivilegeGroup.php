<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivilegeGroup extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Добавляем привелегии к группам =>

        // Пользователь =>
        DB::table('privileges_group')->insert([
            'unique_id'    => 1,
            'name'         => 'Пользователь',
            'privilege_id' => 1 // Просмотр квестов
        ]);
        DB::table('privileges_group')->insert([
            'unique_id'    => 1,
            'name'         => 'Пользователь',
            'privilege_id' => 2 // Прохождение квестов
        ]);

        // Автор =>
        DB::table('privileges_group')->insert([
            'unique_id'    => 2,
            'name'         => 'Автор',
            'privilege_id' => 1 // Просмотр квестов
        ]);
        DB::table('privileges_group')->insert([
            'unique_id'    => 2,
            'name'         => 'Автор',
            'privilege_id' => 2 // Прохождение квестов
        ]);
        DB::table('privileges_group')->insert([
            'unique_id'    => 2,
            'name'         => 'Автор',
            'privilege_id' => 3 // Создать квест
        ]);

        // Модератор =>
        DB::table('privileges_group')->insert([
            'unique_id'    => 3,
            'name'         => 'Модератор',
            'privilege_id' => 1 // Просмотр квестов
        ]);
        DB::table('privileges_group')->insert([
            'unique_id'    => 3,
            'name'         => 'Модератор',
            'privilege_id' => 2 // Прохождение квестов
        ]);
        DB::table('privileges_group')->insert([
            'unique_id'    => 3,
            'name'         => 'Модератор',
            'privilege_id' => 3 // Создать квест
        ]);
        DB::table('privileges_group')->insert([
            'unique_id'    => 3,
            'name'         => 'Модератор',
            'privilege_id' => 4 // Управление всеми квестами
        ]);

        // Админ =>
        DB::table('privileges_group')->insert([
            'unique_id'    => 4,
            'name'         => 'Админ',
            'privilege_id' => 1 // Просмотр квестов
        ]);
        DB::table('privileges_group')->insert([
            'unique_id'    => 4,
            'name'         => 'Админ',
            'privilege_id' => 2 // Прохождение квестов
        ]);
        DB::table('privileges_group')->insert([
            'unique_id'    => 4,
            'name'         => 'Админ',
            'privilege_id' => 3 // Создать квест
        ]);
        DB::table('privileges_group')->insert([
            'unique_id'    => 4,
            'name'         => 'Админ',
            'privilege_id' => 4 // Управление всеми квестами (+ принятия/отклонения квестов на публикацию)
        ]);
        DB::table('privileges_group')->insert([
            'unique_id'    => 4,
            'name'         => 'Админ',
            'privilege_id' => 5 // Управление аккаунтами
        ]);
    }
}
