<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetdrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('getdrugs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gdRID')->lenght(20)->unsigned()->unique()->comment('挂号id');
            $table->string('gddocID')->comment('开药医生工号');
            $table->integer('gddrugID')->comment('建议药物id');
            $table->integer('gdsugnum')->comment('建议药物数量');
            $table->string('gdoperatorID')->comment('取药医生工号');
            $table->integer('gdnum')->comment('取药数量');
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
        Schema::dropIfExists('getdrugs');
    }
}
