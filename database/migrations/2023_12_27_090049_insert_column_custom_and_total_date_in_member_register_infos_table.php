<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertColumnCustomAndTotalDateInMemberRegisterInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_register_infos', function (Blueprint $table) {
            $table->string('custom')->nullable();
            $table->unsignedBigInteger('total_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member_register_infos', function (Blueprint $table) {
            $table->dropColumn('custom');
            $table->dropColumn('total_date');
        });
    }
}
