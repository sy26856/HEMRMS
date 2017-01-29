<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoschargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoscharges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hcuserID')->comment('用户id');
            $table->integer('hcdocID')->comment('收费医生id');
            $table->integer('hccost')->comment('费用充值');
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
        Schema::dropIfExists('hoscharges');
    }
}
