<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('address');
            $table->string('orders_method')->default(\App\Enums\OrderMethod::IMMEDIATE);
            $table->decimal('total_price');
            $table->decimal('shipping_price');
            $table->decimal('discount_price');
            $table->string('status')->default(\App\Enums\OrderStatus::WAIT_PAYMENT);
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
            $table->dropColumn('address');
            $table->dropColumn('orders_method');
            $table->dropColumn('total_price');
            $table->dropColumn('shipping_price');
            $table->dropColumn('discount_price');
            $table->dropColumn('status');
        });
    }
}
