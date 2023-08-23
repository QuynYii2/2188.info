<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MarketingBanner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('top_seller_configs', function (Blueprint $table) {
            $table->string('product')->default(0);
            $table->string('name_custom');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('top_seller_configs', function (Blueprint $table) {
            $table->dropColumn('product');
            $table->dropColumn('name_custom');
        });
    }
}
