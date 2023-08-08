<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertColumnToShopInforV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shop_infos', function (Blueprint $table) {
            $table->string('inspection_staff')->nullable();
            $table->string('test_method')->nullable();
            $table->string('annual_output')->nullable();
            $table->string('partner')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shop_infor_v2', function (Blueprint $table) {
            //
        });
    }
}
