<?php
/**
 * Миграция таблицы соединяющая шаг прохождения и варианта ответа квеста
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuestStepQuestStepOption extends Migration {

    public function up() {
        Schema::create('quest_step_quest_step_option', function (Blueprint $table) {
            $table->integer('quest_step_id')->unsigned();
            $table->integer('quest_step_option_id')->unsigned();
        });

        Schema::table('quest_step_quest_step_option', function (Blueprint $table) {
            $table->foreign('quest_step_id')->references('id')->on('quest_step');
            $table->foreign('quest_step_option_id')->references('id')->on('quest_step_option');
        });
    }

    public function down() {
        Schema::dropIfExists('quest_step_quest_step_option');
    }
}
