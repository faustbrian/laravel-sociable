<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSociablesTable extends Migration
{
    public function up()
    {
        Schema::create('sociables', function (Blueprint $table) {
            $table->increments('id');

            $table->morphs('model');
            $table->string('provider');

            $table->string('token');
            $table->string('uid');
            $table->string('nickname')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('avatar')->nullable();
            $table->json('user');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('sociables');
    }
}
