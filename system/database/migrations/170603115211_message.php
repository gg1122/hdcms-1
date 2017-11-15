<?php namespace system\database\migrations;

use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;

class message extends Migration
{
    //执行
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('mobile', 100);
            $table->string('mail', 100);
            $table->integer('sendtime');
            $table->text('data');
            $table->char('ip', 30);
        });
    }

    //回滚
    public function down()
    {
        Schema::drop('message');
    }
}