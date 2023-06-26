<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertColumnDatetimeToStatisticAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('statistic_accesses', function (Blueprint $table) {
            $table->timestamp('datetime')->default(Carbon::now()->addHours(7));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('statistic_accesses', function (Blueprint $table) {
            $table->dropColumn('datetime');
        });
    }
}
