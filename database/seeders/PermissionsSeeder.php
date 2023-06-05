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

        // Tạo các permission mẫu
        $permissions1 = [
            ['name' => 'view_profile'],
            ['name' => 'view_all_products'],
            ['name' => 'view_list_categories'],
            ['name' => 'order_product'],
            ['name' => 'view_product_language'],
            ['name' => 'view_more_product'],
            ['name' => 'comment_product'],
            ['name' => 'view_all_blogs'],
        ];

        // Lưu các permission vào bảng
        foreach ($permissions as $permissionData) {
            Permission::create($permissionData);
        }

        foreach ($permissions1 as $permissionData) {
            Permission::create($permissionData);
        }
    }
}
