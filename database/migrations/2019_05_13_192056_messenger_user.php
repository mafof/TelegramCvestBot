<?php
/**
 * Миграция таблицы пользователя из мессенджера
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessengerUser extends Migration {

    public function up() {
        Schema::create('messenger_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('messenger_identifier');
            $table->integer('quest_done_count');
            $table->integer('quest_created_count');
            $table->string('messenger_type');
            $table->integer('user_id')->unsigned();
            $table->string('confirm_code')->nullable();
        });

        Schema::table('messenger_user', function (Blueprint $table) {
           $table->foreign('user_id')->references('id')->on('user_list');
        });
    }

    public function down() {
        Schema::dropIfExists('messenger_user');
    }
}
