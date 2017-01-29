<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('docname',20)->comment('医生姓名');
            $table->string('docID',20)->comment('医生工号');
            $table->string('password',255)->comment('医生登陆密码');
            $table->char('docIDCard',18)->unique()->comment('医生身份证');
            $table->string('docphoneNum')->unique()->comment('医生手机号码');
            $table->char('docsex',2)->comment('医生性别');
            $table->smallInteger('docgrade')->unsigned()->comment('医生等级');
            $table->integer('departmentID')->unsigned()->comment('医生所处科室id');
            $table->text('docinfo')->nullable()->comment('医生详细情况介绍');
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
        Schema::dropIfExists('doctors');
    }
}
