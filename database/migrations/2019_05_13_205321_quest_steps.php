<?php
/**
 * Миграция таблицы шага прохождения квеста
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuestSteps extends Migration {

    public function up() {
        Schema::create('quest_steps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->string('describe');
            $table->string('describe_image'); // path or url
        });
    }

    public function down() {
        Schema::dropIfExists('quest_steps');
    }
}
