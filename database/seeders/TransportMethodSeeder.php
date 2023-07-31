<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransportMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transport_methods')->insert([
            ['name' => 'Đường bộ'],
            ['name' => 'Đường thủy'],
            ['name' => 'Đường hàng không'],
        ]);
    }
}
