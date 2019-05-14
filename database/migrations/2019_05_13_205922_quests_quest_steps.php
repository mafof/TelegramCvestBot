<?php
/**
 * Миграция таблицы соединяющая квест и шаг прохождения квеста
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuestsQuestSteps extends Migration {

    public function up() {
        Schema::create('quests_quest_steps', function (Blueprint $table) {
            $table->integer('quest_id')->unsigned();
            $table->integer('quest_step_id')->unsigned();
        });

        Schema::table('quests_quest_steps', function (Blueprint $table) {
            $table->foreign('quest_id')->references('id')->on('quests');
            $table->foreign('quest_step_id')->references('id')->on('quest_steps');
        });
    }

    public function down() {
        Schema::dropIfExists('quests_quest_steps');
    }
}
