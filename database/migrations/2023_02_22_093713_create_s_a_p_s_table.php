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
        Schema::create('sapbp', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('type')->nullable();
            $table->string('name');
            $table->string('billing_address')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('tin')->nullable();
            $table->string('style')->nullable();
            $table->string('sales_employee')->nullable();
            $table->string('wtax_code')->nullable();
            $table->string('isOnHold')->nullable();
            $table->string('isAutoEmail')->nullable();
            $table->string('AR_inCharge')->nullable();
            $table->string('AR_email')->nullable();
            $table->string('bir_attachment')->nullable();
            $table->string('payment_terms')->nullable();
            $table->string('contact_name1')->nullable();
            $table->string('contact_no1')->nullable();
            $table->string('contact_email1')->nullable();
            $table->string('contact_name2')->nullable();
            $table->string('contact_no2')->nullable();
            $table->string('contact_email2')->nullable();
            $table->string('contact_name3')->nullable();
            $table->string('contact_no3')->nullable();
            $table->string('contact_email3')->nullable();
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
        Schema::dropIfExists('sapbp');
    }
};
