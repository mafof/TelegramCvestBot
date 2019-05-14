<?php
/**
 * Миграция таблицы всех привелегий
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Privileges extends Migration {

    public function up() {
        Schema::create('privileges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
        });
    }

    public function down() {
        Schema::dropIfExists('privileges');
    }
}
