<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertMultilColumnLanguageFromAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attributes', function (Blueprint $table) {
            $table->string('name_vi')->nullable();
            $table->string('name_cn')->nullable();
            $table->string('name_kr')->nullable();
            $table->string('name_jp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attributes', function (Blueprint $table) {
            $table->dropColumn('name_vi');
            $table->dropColumn('name_cn');
            $table->dropColumn('name_kr');
            $table->dropColumn('name_jp');
        });
    }
}
