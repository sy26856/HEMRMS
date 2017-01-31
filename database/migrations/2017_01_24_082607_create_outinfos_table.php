<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outinfos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('outRID')->lenght(20)->unsigned()->unique()->comment('挂号id');
            $table->integer('outdepID')->unsigned()->comment('科室id');
            $table->string('outdocID')->comment('医生工号');
            $table->integer('outproID')->unsigned()->comment('检查项目id');
            $table->text('outresult')->comment('项目结果');
            $table->text('outsuggest')->comment('医生建议');
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
        Schema::dropIfExists('outinfos');
    }
}
