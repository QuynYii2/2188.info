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
            ['name' => 'Nâng cấp sản phẩm hot'],
            ['name' => 'Nâng cấp sản phẩm nổi bật'],
            ['name' => 'Nâng cấp thành top-seller'],
            ['name' => 'Nâng cấp sản phẩm bán chạy'],
            ['name' => 'comment_product'],
            ['name' => 'view_all_blogs'],
        ];

        // Tạo các permission mẫu
        $permissionRegisterMember = [
            ['name' => 'find B2C products'],
            ['name' => 'buy B2C household'],
            ['name' => 'find products'],
            ['name' => 'find partners transaction'],
            ['name' => 'display capacity at the product display section'],
            ['name' => 'send new product message'],
            ['name' => 'send messages to promote new products'],
            ['name' => 'provide order program'],
            ['name' => 'display accessories and supplies'],
            ['name' => 'put on dedicated display'],
        ];

        // Lưu các permission vào bảng
        foreach ($permissions as $permissionData) {
            Permission::create($permissionData);
        }

        foreach ($permissions1 as $permissionData) {
            Permission::create($permissionData);
        }

        foreach ($permissionRegisterMember as $permissionData) {
            Permission::create($permissionData);
        }
    }
}
