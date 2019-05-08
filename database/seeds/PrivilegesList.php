<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivilegesList extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Список всех привелегий =>
        DB::table('privileges_listed')->insert([
            'unique_id'   => 1,
            'name'        => 'Просмотр квестов',
            'description' => 'Привилегия дающая право просматривать список квестов на сайте'
        ]);

        DB::table('privileges_listed')->insert([
            'unique_id'   => 2,
            'name'        => 'Прохождение квестов',
            'description' => 'Привилегия дающая право проходить квесты у бота'
        ]);

        DB::table('privileges_listed')->insert([
            'unique_id'   => 3,
            'name'        => 'Создание квестов',
            'description' => 'Привилегия дающая право создавать/редактировать/удалять свои квесты для бота'
        ]);

        DB::table('privileges_listed')->insert([
            'unique_id'   => 4,
            'name'        => 'Управление всеми квестами',
            'description' => 'Привилегия дающая право создавать/редактировать/удалять/принимать/отклонять квесты всех пользователей для бота'
        ]);

        DB::table('privileges_listed')->insert([
            'unique_id'   => 5,
            'name'        => 'Управление аккаунтами',
            'description' => 'Привилегия дающая право редактировать аккаунты пользователей'
        ]);
    }
}
