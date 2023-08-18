<?php

use App\Enums\MemberPartnerStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_partners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id_source');
            $table->foreign('company_id_source')->references('id')->on('member_register_infos')->onDelete('cascade');
            $table->unsignedBigInteger('company_id_follow');
            $table->foreign('company_id_follow')->references('id')->on('member_register_infos')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price');
            $table->string('status')->default(MemberPartnerStatus::ACTIVE);
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
        Schema::dropIfExists('member_partners');
    }
}
