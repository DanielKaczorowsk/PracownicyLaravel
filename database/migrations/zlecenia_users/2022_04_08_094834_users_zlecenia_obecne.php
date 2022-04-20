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
      Schema::create('obecne_users', function (Blueprint $table) {
          $table->unsignedInteger('user_id');
          $table->unsignedInteger('obecne_zlecenia_id');
          $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
          $table->foreign('obecne_zlecenia_id')->references('id')->on('obecne_zlecenias')->onDelete('CASCADE');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obecne_users');
    }
};
