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
        Schema::create('phone_sim_requests', function (Blueprint $table) {
            $table->id();
            $table->string('pr_no');
            $table->string('item');
            $table->string('description');
            $table->string('remarks');
            $table->string('req_by');
            $table->string('site');
            $table->string('status');
            $table->string('date_req');
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
        Schema::dropIfExists('phone_sim_requests');
    }
};
