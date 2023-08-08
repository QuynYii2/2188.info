<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertColumnToShopInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shop_infos', function (Blueprint $table) {
            $table->string('acreage')->nullable();
            $table->string('industry_year')->nullable();
            $table->string('machine_number')->nullable();
            $table->string('marketing')->nullable();
            $table->string('customers')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shop_infos', function (Blueprint $table) {
            //
        });
    }
}
