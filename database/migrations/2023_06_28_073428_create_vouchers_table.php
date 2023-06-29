<?php

use App\Enums\VoucherStatus;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('code');
            $table->integer('quantity')->default(1);
            $table->float('percent');
            $table->string('apply');
            $table->timestamp('startDate')->default(Carbon::now()->addHours(7));
            $table->timestamp('endDate')->default(Carbon::now()->addHours(7)->addDay());
            $table->string('description')->nullable();
            $table->string('status')->default(VoucherStatus::ACTIVE);
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
        Schema::dropIfExists('vouchers');
    }
}
