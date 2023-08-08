<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertColumnTranslateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('name_vi')->nullable();
            $table->string('name_ja')->nullable();
            $table->string('name_ko')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_zh')->nullable();

            $table->string('description_vi')->nullable();
            $table->string('description_ja')->nullable();
            $table->string('description_ko')->nullable();
            $table->string('description_en')->nullable();
            $table->string('description_zh')->nullable();

            $table->string('short_description_vi')->nullable();
            $table->string('short_description_ja')->nullable();
            $table->string('short_description_ko')->nullable();
            $table->string('short_description_en')->nullable();
            $table->string('short_description_zh')->nullable();
        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
