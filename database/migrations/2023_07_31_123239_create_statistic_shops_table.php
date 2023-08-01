<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_shops', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('access')->nullable();
            $table->integer('views')->nullable();
            $table->integer('orders')->nullable();
            $table->timestamp('datetime')->default(Carbon::now()->addHours(7));
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
        Schema::dropIfExists('statistic_shops');
    }
}
