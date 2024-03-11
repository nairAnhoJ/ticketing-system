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
        Schema::create('phone_sim_histories', function (Blueprint $table) {
            $table->id();
            $table->string('ps_id');
            $table->string('user');
            $table->string('department');
            $table->string('site');
            $table->string('date_issued');
            $table->string('remarks');
            $table->string('to');
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
        Schema::dropIfExists('phone_sim_histories');
    }
};
