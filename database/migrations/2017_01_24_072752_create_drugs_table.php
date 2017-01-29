<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('drugname')->comment('药物名');
            $table->text('druginfo')->nullable()->comment('药物介绍');
            $table->integer('drugdepID')->unsigned()->comment('药物所属科室ID');
            $table->integer('drugnum')->comment('药物的存储数量');
            $table->integer('drugprice')->lenght(10)->comment('单次药物价格');

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
        Schema::dropIfExists('drugs');
    }
}
