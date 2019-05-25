<?php
/**
 * Миграция таблицы варианта ответа у шага квеста
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuestStepOptions extends Migration {

    public function up() {
        Schema::create('quest_step_options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('button_text');
            $table->integer('quest_step_id')->unsigned();
        });

        Schema::table('quest_step_options', function (Blueprint $table) {
            $table->foreign('quest_step_id')->references('id')->on('quest_steps');
        });
    }

    public function down() {
        Schema::dropIfExists('quest_step_options');
    }
}
