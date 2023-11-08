<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertColumnLanguageInVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('name_vi')->nullable();
            $table->string('name_kr')->nullable();
            $table->string('name_jp')->nullable();
            $table->string('name_cn')->nullable();

            $table->string('description_en')->nullable();
            $table->string('description_vi')->nullable();
            $table->string('description_kr')->nullable();
            $table->string('description_jp')->nullable();
            $table->string('description_cn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->string('name_en');
            $table->string('name_vi');
            $table->string('name_kr');
            $table->string('name_jp');
            $table->string('name_cn');

            $table->string('description_en');
            $table->string('description_vi');
            $table->string('description_kr');
            $table->string('description_jp');
            $table->string('description_cn');
        });
    }
}
