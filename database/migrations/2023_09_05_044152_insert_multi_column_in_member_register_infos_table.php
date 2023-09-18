<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertMultiColumnInMemberRegisterInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_register_infos', function (Blueprint $table) {
            $table->timestamp('datetime_register')->nullable();
            $table->string('number_clearance')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_kr')->nullable();
            $table->string('address_en')->nullable();
            $table->string('address_kr')->nullable();
            $table->string('certify_business')->nullable();
            $table->string('status_business')->nullable();
            $table->string('code_1')->nullable();
            $table->string('code_2')->nullable();
            $table->string('code_3')->nullable();
            $table->string('code_4')->nullable();
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
            $table->dropColumn('datetime_register');
            $table->dropColumn('number_clearance');
            $table->dropColumn('name_en');
            $table->dropColumn('name_kr');
            $table->dropColumn('address_en');
            $table->dropColumn('address_kr');
            $table->dropColumn('certify_business');
            $table->dropColumn('status_business');
            $table->dropColumn('code_1');
            $table->dropColumn('code_2');
            $table->dropColumn('code_3');
            $table->dropColumn('code_4');
        });
    }
}
