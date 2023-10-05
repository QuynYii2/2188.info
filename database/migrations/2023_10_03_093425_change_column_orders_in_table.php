<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnOrdersInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('total_price', 15, 2)->change();
            $table->decimal('total', 15, 2)->change();
            $table->decimal('shipping_price', 15, 2)->change();
            $table->decimal('discount_price', 15, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('total_price', 8, 2)->change();
            $table->decimal('total', 8, 2)->change();
            $table->decimal('shipping_price', 8, 2)->change();
            $table->decimal('discount_price', 8, 2)->change();
        });
    }
}
