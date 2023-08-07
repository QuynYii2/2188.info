<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CheckPaymentWhenRegisterMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_register_person_sources', function (Blueprint $table) {
            $table->integer('check')->default(0);
            $table->integer('price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member_register_person_sources', function (Blueprint $table) {
            $table->dropColumn('check');
            $table->dropColumn('price');
        });
    }
}
