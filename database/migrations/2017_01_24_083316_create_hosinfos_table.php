<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHosinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosinfos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hosRID')->lenght(20)->unsigned()->unique()->comment('挂号id');
            $table->integer('hosdepID')->unsigned()->comment('科室id');
            $table->integer('hosdocID')->unsigned()->comment('医生id');
            $table->integer('hosproID')->unsigned()->comment('检查项目id');
            $table->text('hosresult')->comment('项目结果');
            $table->text('hossuggest')->comment('医生建议');
            $table->integer('hosleft')->unsigned()->comment('名下剩余费用');
            $table->integer('hosbedID')->unsigned()->comment('床位信息表id');
            $table->smallInteger('hosstatus')->comment('住院状态(0仍在住院or1出院)');
            $table->integer('hosallowID')->comment('出院负责人签字id');
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
        Schema::dropIfExists('hosinfos');
    }
}
