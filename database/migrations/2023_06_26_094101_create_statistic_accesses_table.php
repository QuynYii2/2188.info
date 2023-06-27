<?php

use App\Enums\StatisticStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_accesses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('numbers');
            $table->string('description')->nullable();
            $table->string('status')->default(StatisticStatus::ACTIVE);
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
        Schema::dropIfExists('statistic_accesses');
    }
}
