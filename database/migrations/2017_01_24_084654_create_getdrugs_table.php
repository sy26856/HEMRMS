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
            $table->integer('gddocID')->comment('开药医生id');
            $table->integer('gddrugID')->comment('建议药物id');
            $table->integer('gdsugnum')->comment('建议药物数量');
            $table->integer('gdoperatorID')->comment('取药医生id');
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
