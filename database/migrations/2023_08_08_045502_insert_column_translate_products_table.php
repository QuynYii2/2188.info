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
            $table->mediumText('name_vi')->nullable();
            $table->mediumText('name_ja')->nullable();
            $table->mediumText('name_ko')->nullable();
            $table->mediumText('name_en')->nullable();
            $table->mediumText('name_zh')->nullable();

            $table->longText('description_vi')->nullable();
            $table->longText('description_ja')->nullable();
            $table->longText('description_ko')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('description_zh')->nullable();

            $table->longText('short_description_vi')->nullable();
            $table->longText('short_description_ja')->nullable();
            $table->longText('short_description_ko')->nullable();
            $table->longText('short_description_en')->nullable();
            $table->longText('short_description_zh')->nullable();
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
