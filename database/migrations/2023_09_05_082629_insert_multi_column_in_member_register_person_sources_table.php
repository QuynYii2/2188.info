<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertMultiColumnInMemberRegisterPersonSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_register_person_sources', function (Blueprint $table) {
            $table->timestamp('datetime_register')->nullable();
            $table->string('name_en')->nullable();
            $table->string('responsibility')->nullable();
            $table->string('position')->nullable();
            $table->string('code')->nullable();
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
            $table->dropColumn('datetime_register');
            $table->dropColumn('name_en');
            $table->dropColumn('responsibility');
            $table->dropColumn('position');
            $table->dropColumn('code');
        });
    }
}
