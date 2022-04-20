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
      Schema::create('wykonane_zlecenias', function (Blueprint $table) {
          $table->increments('id');
          $table->string('urzadzenie');
          $table->string('usterka');
          $table->string('uwaga');
          $table->string('spis');
          $table->double('koszty');
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
        Schema::dropIfExists('wykonane_zlecenias');
    }
};
