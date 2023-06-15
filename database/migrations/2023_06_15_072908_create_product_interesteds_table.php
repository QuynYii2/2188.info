<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInterestedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_interesteds', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('categories_id')->nullable();
            $table->string('status')->default(\App\Enums\ProductInterestedStatus::ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_interesteds');
    }
}
