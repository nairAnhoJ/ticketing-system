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
            $table->text('remarks')->nullable();
            $table->string('invoice_no');
            $table->string('date_purchased');
            $table->string('status');
            $table->string('is_Defective')->default('0');
            $table->integer('is_disposed')->default('0');
            $table->integer('for_disposal')->default('0');
            $table->bigInteger('computer_id');
            $table->bigInteger('site_id');
            $table->string('date_returned')->default('N/A');
            $table->string('prev_user_dept')->default('N/A');
            $table->string('return_remarks')->default('N/A');
            $table->string('prev_user')->default('N/A');
            $table->text('i_date_issued')->nullable();
            $table->text('i_remarks')->nullable();
            $table->text('i_status')->nullable();
            $table->text('i_color')->nullable();
            $table->text('i_cost')->nullable(0);
            $table->text('i_department')->nullable();
            $table->text('i_user')->nullable();
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
