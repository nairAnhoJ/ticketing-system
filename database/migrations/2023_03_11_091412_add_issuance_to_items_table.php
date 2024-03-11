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
        Schema::table('items', function (Blueprint $table) {
            $table->text('i_date_issued')->after('site_id')->nullable();
            $table->text('i_remarks')->after('site_id')->nullable();
            $table->text('i_status')->after('site_id')->nullable();
            $table->text('i_color')->after('site_id')->nullable();
            $table->text('i_cost')->after('site_id')->nullable();
            $table->text('i_department')->after('site_id')->nullable();
            $table->text('i_user')->after('site_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            //
        });
    }
};
