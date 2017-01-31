<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdddrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adddrugs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('addrugID')->comment('药物id');
            $table->string('addocID')->comment('加药医生工号');
            $table->integer('adnum')->comment('添加药物数量');
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
        Schema::dropIfExists('adddrugs');
    }
}
