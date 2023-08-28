<?php

use App\Enums\ChatRequestStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('from_user_id');
            $table->integer('to_user_id');
            $table->string('status')->default(ChatRequestStatus::PENDING);
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
        Schema::dropIfExists('chat_requests');
    }
}
