<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsVnpayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments_vnpay', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cost_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('money')->nullable()->comment('Số tiền thanh toán');
            $table->string('note')->nullable()->comment('Nội dung thanh toán');
            $table->string('vnp_response_code',255)->nullable()->comment('Mã phản hồi');
            $table->string('code_vnpay',255)->nullable()->comment('Mã giao dịch VnPay');
            $table->string('code_bank',255)->nullable()->comment('Mã ngân hàng');
            $table->dateTime('time')->nullable()->comment('Thời gian chuyển khoản');
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
        Schema::dropIfExists('payments_vnpay');
    }
}
