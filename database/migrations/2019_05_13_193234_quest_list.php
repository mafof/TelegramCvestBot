<?php
/**
 * Миграция таблицы квестов
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuestList extends Migration {

    public function up() {
        Schema::create('quest_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('quest_name');
            $table->string('quest_description');
            $table->integer('quest_author')->unsigned();
            $table->integer('quest_rating');
            $table->boolean('quest_is_confirm');
        });

        Schema::table('quest_list', function (Blueprint $table) {
            $table->foreign('quest_author')->references('id')->on('user_list');
        });
    }

    public function down() {
        Schema::dropIfExists('quest_list');
    }
}
