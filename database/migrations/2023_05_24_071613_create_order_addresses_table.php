<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('username');
            $table->string('company');
            $table->string('phone');
            $table->string('city');
            $table->string('province');
            $table->string('location');
            $table->string('address_detail');
            $table->string('address_option')->default(\App\Enums\AddressOrderOption::HOME_PRIVATE);
            $table->integer('default')->default(\App\Enums\AddressOrder::ABSENCE);
            $table->string('status')->default(\App\Enums\AddressOrderStatus::ACTIVE);
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
        Schema::dropIfExists('order_addresses');
    }
}
