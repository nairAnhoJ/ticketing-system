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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_no', 10);
            $table->bigInteger('user_id');
            $table->bigInteger('department');
            $table->bigInteger('nature_of_problem');
            $table->bigInteger('assigned_to');
            $table->string('subject', 100);
            $table->binary('description');
            $table->binary('update')->nullable();
            $table->binary('resolution')->nullable();
            $table->string('attachment', 100)->nullable();
            $table->string('status', 10)->default('PENDING');
            $table->bigInteger('done_by')->nullable();
            $table->dateTime('start_date_time')->nullable();
            $table->dateTime('end_date_time')->nullable();
            $table->string('resolution_attachment', 100)->nullable();

            // $table->integer('is_SAP');
            // $table->string('code', 20)->nullable();
            // $table->string('type', 50)->nullable();
            // $table->string('name')->nullable();
            // $table->string('billing_address')->nullable();
            // $table->string('shipping_address')->nullable();
            // $table->string('tin', 20)->nullable();
            // $table->string('style', 50)->nullable();
            // $table->string('sales_employee', 100)->nullable();
            // $table->string('wtax_code', 50)->nullable();
            // $table->string('isOnHold', 5)->nullable();
            // $table->string('isAutoEmail', 5)->nullable();
            // $table->string('AR_inCharge', 100)->nullable();
            // $table->string('AR_email', 100)->nullable();
            // $table->string('bir_attachment', 100)->nullable();
            // $table->string('payment_terms', 50)->nullable();
            // $table->string('contact_name1', 100)->nullable();
            // $table->string('contact_no1', 50)->nullable();
            // $table->string('contact_email1', 100)->nullable();
            // $table->string('contact_name2', 100)->nullable();
            // $table->string('contact_no2', 50)->nullable();
            // $table->string('contact_email2', 100)->nullable();
            // $table->string('contact_name3', 100)->nullable();
            // $table->string('contact_no3', 50)->nullable();
            // $table->string('contact_email3', 100)->nullable();
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
        Schema::dropIfExists('tickets');
    }
};
