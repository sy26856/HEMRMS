<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBedinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bedinfos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('biRID')->lenght(20)->unsigned()->unique()->comment('生成的挂号号码');
            $table->integer('bibedID')->unsigned()->comment('床位id');
            $table->integer('bidocID')->comment('开床位医生id');
            $table->text('biremark')->comment('备注');
            $table->smallInteger('bistatus')->comment('状态(0已经还/1未还)');
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
        Schema::dropIfExists('bedinfos');
    }
}
