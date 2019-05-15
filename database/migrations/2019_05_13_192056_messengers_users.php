<?php
/**
 * Миграция таблицы пользователя из мессенджера
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessengersUsers extends Migration {

    public function up() {
        Schema::create('messengers_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('messenger_identifier');
            $table->integer('quest_done_count')->default(0);
            $table->integer('quest_created_count')->default(0);
            $table->integer('messenger_type');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('confirm_code')->nullable();
        });

        Schema::table('messengers_users', function (Blueprint $table) {
           $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down() {
        Schema::dropIfExists('messengers_users');
    }
}
