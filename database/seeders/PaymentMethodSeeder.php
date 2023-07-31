<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            ['name' => 'Nhận hàng thanh toán'],
            ['name' => 'Thanh toán thẻ nội địa'],
            ['name' => 'Thanh toán qua Paypal'],
        ]);
    }
}
