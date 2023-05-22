<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluate_products', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('username');
            $table->integer('product_id');
            $table->integer('star_number')->default(1);
            $table->string('content');
            $table->string('status')->default(\App\Enums\EvaluateProductStatus::PENDING);
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
        Schema::dropIfExists('evaluate_products');
    }
}
