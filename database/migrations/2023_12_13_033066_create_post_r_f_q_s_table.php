<?php

use App\Enums\PostRFQStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostRFQSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_r_f_q_s', function (Blueprint $table) {
            $table->id();

            $table->string('product_name');
            $table->string('product_name_en');
            $table->string('product_name_vi');
            $table->string('product_name_ko');
            $table->string('product_name_zh');
            $table->string('product_name_ja');

            $table->longText('description');
            $table->longText('description_en');
            $table->longText('description_vi');
            $table->longText('description_ko');
            $table->longText('description_zh');
            $table->longText('description_ja');

            $table->longText('thumbnails');

            $table->string('code_1')->comment('Phân loại lần 1');
            $table->string('code_2')->comment('Phân loại lần 2');
            $table->string('code_3')->comment('Phân loại lần 3');

            $table->string('purchase_quantity')->comment('Số lượng');
            $table->string('unit_quantity')->comment('Đơn vị số lượng');
            $table->string('business_terms')->comment('Điều khoản kinh doanh');
            $table->string('target_price')->comment('Giá mong muốn ');
            $table->string('unit_price')->comment('Đơn vị giá');
            $table->string('max_budget')->comment('Ngân sách tối đa');

            $table->string('shipping_method')->comment('Phương thức giao hàng');
            $table->string('destination_port')->comment('Vận chuyển đến cảng');
            $table->float('ship_in')->comment('Thời gian ship');
            $table->string('payment_terms')->comment('Điều khoản thanh toán');

            $table->string('create_by');

            $table->string('status')->default(PostRFQStatus::PENDING);
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
        Schema::dropIfExists('post_r_f_q_s');
    }
}
