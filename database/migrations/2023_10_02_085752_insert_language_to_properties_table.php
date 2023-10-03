<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertLanguageToPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->mediumText('name_vi')->nullable();
            $table->mediumText('name_ja')->nullable();
            $table->mediumText('name_ko')->nullable();
            $table->mediumText('name_en')->nullable();
            $table->mediumText('name_zh')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('name_vi');
            $table->dropColumn('name_ja');
            $table->dropColumn('name_ko');
            $table->dropColumn('name_en');
            $table->dropColumn('name_zh');
        });
    }
}
