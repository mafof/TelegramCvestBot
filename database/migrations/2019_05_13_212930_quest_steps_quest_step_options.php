<?php
/**
 * Миграция таблицы соединяющая шаг прохождения и варианта ответа квеста
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuestStepsQuestStepOptions extends Migration {

    public function up() {
        Schema::create('quest_steps_quest_step_options', function (Blueprint $table) {
            $table->integer('quest_step_id')->unsigned();
            $table->integer('quest_step_option_id')->unsigned();
        });

        Schema::table('quest_steps_quest_step_options', function (Blueprint $table) {
            $table->foreign('quest_step_id')->references('id')->on('quest_steps');
            $table->foreign('quest_step_option_id')->references('id')->on('quest_step_options');
        });
    }

    public function down() {
        Schema::dropIfExists('quest_steps_quest_step_options');
    }
}
