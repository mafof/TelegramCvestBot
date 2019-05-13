<?php
/**
 * Миграция таблицы всех групп
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GroupList extends Migration {

    public function up() {
        Schema::create('group_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
        });
    }

    public function down() {
        Schema::dropIfExists('group_list');
    }
}
