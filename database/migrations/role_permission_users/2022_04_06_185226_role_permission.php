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
      Schema::create('role_permissions', function (Blueprint $table) {
          $table->unsignedInteger('role_id');
          $table->unsignedInteger('permission_id');
          $table->foreign('role_id')->references('id')->on('roles')->onDelete('CASCADE');
          $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('CASCADE');
          $table->primary(['role_id','permission_id']);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('role_permissions');
    }
};
