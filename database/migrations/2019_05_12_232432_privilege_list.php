<?php
/**
 * Миграция таблицы всех привелегий
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PrivilegeList extends Migration {

    public function up() {
        Schema::create('privilege_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
        });
    }

    public function down() {
        Schema::dropIfExists('privilege_list');
    }
}
