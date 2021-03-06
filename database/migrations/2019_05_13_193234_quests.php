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
            $table->string('name');
            $table->string('description');
            $table->integer('author')->unsigned();
            $table->integer('rating');
            $table->boolean('is_confirm');
            $table->integer('quest_steps_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('quests', function (Blueprint $table) {
            $table->foreign('author')->references('id')->on('users');
            $table->foreign('quest_steps_id')->references('id')->on('quest_steps');
        });
    }

    public function down() {
        Schema::dropIfExists('quests');
    }
}
