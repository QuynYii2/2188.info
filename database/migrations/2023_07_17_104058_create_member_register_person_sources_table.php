<?php

use App\Enums\MemberRegisterPersonSourceStatus;
use App\Enums\MemberRegisterType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberRegisterPersonSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_register_person_sources', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('member_id');
            $table->string('name');
            $table->string('rank');
            $table->string('password');
            $table->string('phone');
            $table->string('email');
            $table->string('verifyCode');
            $table->integer('isVerify')->default(0);
            $table->string('sns_account');
            $table->string('type')->default(MemberRegisterType::SOURCE);
            $table->string('status')->default(MemberRegisterPersonSourceStatus::INACTIVE);
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
        Schema::dropIfExists('member_register_person_sources');
    }
}
