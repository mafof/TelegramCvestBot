<?php
/**
 * Миграция таблицы шага прохождения квеста
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuestStep extends Migration {

    public function up() {
        Schema::create('quest_step', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quest_step_number');
            $table->string('quest_step_describe');
            $table->string('quest_step_describe_image'); // path or url
        });
    }

    public function down() {
        Schema::dropIfExists('quest_step');
    }
}
