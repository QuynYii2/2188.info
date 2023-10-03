<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertColumnToPaymentsVnpayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments_vnpay', function (Blueprint $table) {
            $table->string('orders_method')->nullable();
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
        Schema::table('payments_vnpay', function (Blueprint $table) {
            //
        });
    }
}
