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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('smtp_is_activated');
            $table->string('smtp_server');
            $table->string('smtp_name');
            $table->string('smtp_username');
            $table->string('smtp_password');
            $table->string('smtp_port');
            $table->text('user_agreement_device')->nullable();
            $table->text('user_agreement_phonesim')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
