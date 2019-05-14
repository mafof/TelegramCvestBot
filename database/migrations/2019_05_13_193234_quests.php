<?php
/**
 * Миграция таблицы квестов
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Quests extends Migration {

    public function up() {
        Schema::create('quests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('quest_name');
            $table->string('quest_description');
            $table->integer('quest_author')->unsigned();
            $table->integer('quest_rating');
            $table->boolean('quest_is_confirm');
        });

        Schema::table('quests', function (Blueprint $table) {
            $table->foreign('quest_author')->references('id')->on('users');
        });
    }

    public function down() {
        Schema::dropIfExists('quests');
    }
}
