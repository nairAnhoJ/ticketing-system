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
        Schema::create('phone_sims', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->string('user');
            $table->string('desc');
            $table->string('serial_no');
            $table->string('remarks');
            $table->string('site');
            $table->string('status');
            $table->string('invoice');
            $table->string('date_del');
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
        Schema::dropIfExists('phone_sims');
    }
};
