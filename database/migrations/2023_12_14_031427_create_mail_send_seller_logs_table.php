<?php

use App\Enums\MailSendSellerLogStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailSendSellerLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_send_seller_logs', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('content');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('product_quantity');
            $table->string('product_fn');
            $table->string('status')->default(MailSendSellerLogStatus::ACTIVE);
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
        Schema::dropIfExists('mail_send_seller_logs');
    }
}
