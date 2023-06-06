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
        Schema::create('statistics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('type', ['login', 'logout', 'register','view_buy', 'view_download', 'click_buy', 'click_download']);
            $table->enum('action', ['login', 'logout', 'register', 'view_page', 'button_click']);
            $table->string('ip_address',45)->nullable();
            $table->date('created_at');

            $table->foreign('role_id')->references('id')->on('roles');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistics');
    }
};