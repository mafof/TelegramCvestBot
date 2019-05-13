<?php
/**
 * Миграция пользователей на сайте
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserList extends Migration {

    public function up() {
        Schema::create('user_list', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nickname')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('group')->unsigned();
            $table->boolean('is_ban');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('user_list', function(Blueprint $table) {
            $table->foreign('group')->references('id')->on('group_list');
        });
    }


    public function down() {
        Schema::dropIfExists('user_list');
    }
}
