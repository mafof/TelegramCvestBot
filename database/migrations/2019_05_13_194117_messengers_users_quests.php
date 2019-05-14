<?php
/**
 * Миграция таблицы завершенных квестов у пользователя мессенджера
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessengersUsersQuests extends Migration {

    public function up() {
        Schema::create('messengers_users_quests', function (Blueprint $table) {
            $table->integer('messenger_user_id')->unsigned();
            $table->integer('quest_id')->unsigned();
        });

        Schema::table('messengers_users_quests', function (Blueprint $table) {
            $table->foreign('messenger_user_id')->references('id')->on('messengers_users');
            $table->foreign('quest_id')->references('id')->on('quests');
        });
    }

    public function down() {
        Schema::dropIfExists('messengers_users_quests');
    }
}
