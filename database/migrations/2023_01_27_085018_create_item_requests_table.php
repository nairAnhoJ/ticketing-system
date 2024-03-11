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
        Schema::create('item_requests', function (Blueprint $table) {
            $table->id();
            $table->string('pr_no');
            $table->string('type_id');
            $table->string('brand');
            $table->string('description');
            $table->string('remarks');
            $table->string('quantity');
            $table->string('quantity_delivered')->nullable();
            $table->string('req_by');
            $table->string('site');
            $table->string('status');
            $table->string('date_requested');
            $table->string('date_delivered');
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
        Schema::dropIfExists('item_requests');
    }
};
