<?php
/**
 * Миграция таблицы завершенных квестов у пользователя мессенджера
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessengerUserQuest extends Migration {

    public function up() {
        Schema::create('messenger_user_quest', function (Blueprint $table) {
            $table->integer('messenger_user_id')->unsigned();
            $table->integer('quest_id')->unsigned();
        });

        Schema::table('messenger_user_quest', function (Blueprint $table) {
            $table->foreign('messenger_user_id')->references('id')->on('messenger_user');
            $table->foreign('quest_id')->references('id')->on('quest_list');
        });
    }

    public function down() {
        Schema::dropIfExists('messenger_user_quest');
    }
}
