<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PrivilegesGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privileges_group', function(Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('unique_id');
            $table->unsignedBigInteger('privilege_id');
            $table->string('name'); // Имя группы
        });

        Schema::table('privileges_group', function(Blueprint $table) {
            $table->foreign('privilege_id')->references('unique_id')->on('privileges_listed'); // уникальное ID привелегии
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privileges_group');
    }
}
