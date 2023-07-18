<?php

use App\Enums\MemberRegisterInfoStatus;
use App\Enums\StatusBusiness;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberRegisterInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_register_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->string('phone');
            $table->string('fax');
            $table->string('code_fax');
            $table->string('category_id');
            $table->string('code_business');
            $table->string('number_business');
            $table->string('type_business')->default(StatusBusiness::ACTIVE);
            $table->string('member');
            $table->string('status')->default(MemberRegisterInfoStatus::ACTIVE);
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
        Schema::dropIfExists('member_register_infos');
    }
}
