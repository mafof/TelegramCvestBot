<?php
/**
 * Миграция таблицы группы и доступных привелегий к группе
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GroupPrivilege extends Migration {

    public function up() {
        Schema::create('group_privilege', function (Blueprint $table) {
            $table->integer('group_id')->unsigned();
            $table->integer('privilege_id')->unsigned();
        });

        Schema::table('group_privilege', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('privilege_id')->references('id')->on('privileges');
        });
    }

    public function down() {
        Schema::dropIfExists('group_privilege');
    }
}
