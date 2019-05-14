<?php
/**
 * Миграция таблицы соединяющая квест и шаг прохождения квеста
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuestQuestStep extends Migration {

    public function up() {
        Schema::create('quest_quest_step', function (Blueprint $table) {
            $table->integer('quest_id')->unsigned();
            $table->integer('quest_step_id')->unsigned();
        });

        Schema::table('quest_quest_step', function (Blueprint $table) {
            $table->foreign('quest_id')->references('id')->on('quests');
            $table->foreign('quest_step_id')->references('id')->on('quest_steps');
        });
    }

    public function down() {
        Schema::dropIfExists('quest_quest_step');
    }
}
