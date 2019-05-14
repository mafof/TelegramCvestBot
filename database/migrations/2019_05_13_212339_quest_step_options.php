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
            $table->string('quest_step_option_describe');
        });
    }

    public function down() {
        Schema::dropIfExists('quest_step_options');
    }
}
