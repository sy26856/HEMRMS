<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('用户名');
            $table->string('password')->comment('登录密码');
            $table->char('IDCard',18)->unique()->comment('身份证');
            $table->string('phoneNum')->unique()->comment('手机号码');
            $table->char('sex',2)->comment('性别');
            $table->string('birthday')->comment('生日');
            $table->integer('money')->default(0)->comment("住院费用充值
");
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
