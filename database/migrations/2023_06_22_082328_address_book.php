<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddressBook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('address_book', function (Blueprint $table) {
            $table->string('fullname');
            $table->string('company')->nullable();
            $table->string('number_phone');
            $table->string('province');
            $table->string('district');
            $table->string('wards');
            $table->string('detail');
            $table->string('type');
            $table->string('default');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('address_book', function (Blueprint $table) {
            //
        });
    }
}
