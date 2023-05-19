<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tạo các permission mẫu
        $permissions = [
            ['name' => 'view_dashboard'],
            ['name' => 'manage_products'],
            ['name' => 'manage_orders'],
            // Thêm các permission khác tùy theo nhu cầu của bạn
        ];

        // Lưu các permission vào bảng
        foreach ($permissions as $permissionData) {
            Permission::create($permissionData);
        }
    }
}
