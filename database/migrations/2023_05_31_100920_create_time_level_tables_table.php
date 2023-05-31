<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeLevelTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_level_tables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('level_old')->default(\App\Enums\UserInterestEnum::FREE);
            $table->string('new_level')->default(\App\Enums\UserInterestEnum::FREE);
            $table->string('type_account');
            $table->dateTime('activation_date')->default(Carbon\Carbon::now()->subHours(7));
            $table->float('duration')->default(1);
            $table->dateTime('expiration_date')->default(Carbon\Carbon::now()->subHours(7)->subDays(365));
            $table->float('total_price');
            $table->string('description');
            $table->string('status')->default(\App\Enums\TimeLevelStatus::EXPIRED);
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
        Schema::dropIfExists('time_level_tables');
    }
}
