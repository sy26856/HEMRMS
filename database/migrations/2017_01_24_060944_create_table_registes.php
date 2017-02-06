<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRegistes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->comment('用户表id');
            $table->string('registID')->comment('生成的挂号号码');
            $table->smallInteger('diagnose')->comment('诊断情况(门诊0or住院1)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registes');
    }
}
