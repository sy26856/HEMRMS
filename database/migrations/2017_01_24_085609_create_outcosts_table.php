<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutcostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outcosts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ocRID')->lenght(20)->unsigned()->unique()->comment('挂号id');
            $table->integer('费用')->comment('ocprice');
            $table->smallInteger('ocpay')->default(0)->comment('是否付费(0无/1有)');
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
        Schema::dropIfExists('outcosts');
    }
}
