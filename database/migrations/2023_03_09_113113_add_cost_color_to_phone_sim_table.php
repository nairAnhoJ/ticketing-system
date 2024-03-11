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
        Schema::table('phone_sims', function (Blueprint $table) {
            $table->string('department')->after('user')->default('N/A');
            $table->string('color')->after('status')->default('N/A');
            $table->string('cost')->after('status')->default('N/A');
            $table->string('date_issued')->after('invoice')->default('N/A');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phone_sims', function (Blueprint $table) {
            //
        });
    }
};
