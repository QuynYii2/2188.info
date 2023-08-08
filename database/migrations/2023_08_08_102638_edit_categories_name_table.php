<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditCategoriesNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name_vi')->nullable();
            $table->string('name_ja')->nullable();
            $table->string('name_ko')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_zh')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('name_vi');
            $table->dropColumn('name_ja');
            $table->dropColumn('name_ko');
            $table->dropColumn('name_en');
            $table->dropColumn('name_zh');
        });
    }
}
