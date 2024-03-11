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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('type_id');
            $table->string('code');
            $table->string('brand');
            $table->string('serial_no');
            $table->string('description');
            $table->string('invoice_no');
            $table->string('date_purchased');
            $table->string('status');
            $table->bigInteger('computer_id');
            $table->bigInteger('site_id');
            $table->string('added_by');
            $table->string('edited_by');
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
        Schema::dropIfExists('items');
    }
};
