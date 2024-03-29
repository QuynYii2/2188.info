<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InserColumnPersonFromMemberRegisterPersonSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_register_person_sources', function (Blueprint $table) {
            $table->integer('person')->nullable();
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
            $table->dropColumn('person');
        });
    }
}
