<?php
/**
 * Миграция таблицы группы и доступных привелегий к группе
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GroupsPrivileges extends Migration {

    public function up() {
        Schema::create('groups_privileges', function (Blueprint $table) {
            $table->integer('group_id')->unsigned();
            $table->integer('privilege_id')->unsigned();
        });

        Schema::table('groups_privileges', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('privilege_id')->references('id')->on('privileges');
        });
    }

    public function down() {
        Schema::dropIfExists('groups_privileges');
    }
}
