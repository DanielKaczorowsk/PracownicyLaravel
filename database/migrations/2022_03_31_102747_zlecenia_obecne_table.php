<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('zlecenias', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('id_users');
          $table->string('urzadzenie');
          $table->string('usterka');
          $table->string('uwaga');
          $table->double('limitkosztow');
          $table->rememberToken();
          $table->timestamps();
          $table->foreign('id_users')->references('id')->on('users')->onDelete('CASCADE');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('zlecenia');
    }
};
