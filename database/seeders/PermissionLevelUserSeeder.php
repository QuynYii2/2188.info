<?php

namespace Database\Seeders;

use App\Enums\UserInterestEnum;
use App\Enums\UserStatus;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class PermissionLevelUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lấy user có level free va status active
        $userFrees = User::where([['level_account', UserInterestEnum::FREE], ['status', UserStatus::ACTIVE]])->get();
        $userVips = User::where([['level_account', UserInterestEnum::VIP], ['status', UserStatus::ACTIVE]])->get();
        $userVVips = User::where([['level_account', UserInterestEnum::VVIP], ['status', UserStatus::ACTIVE]])->get();
        $userSVips = User::where([['level_account', UserInterestEnum::SVIP], ['status', UserStatus::ACTIVE]])->get();

        // Lấy permission view_all_product
        $viewProductPermission = Permission::where('name', 'view_all_products')->first();
        $viewProfilePermission = Permission::where('name', 'view_profile')->first();
        $viewListCategoryPermission = Permission::where('name', 'view_list_categories')->first();
        $orderProductPermission = Permission::where('name', 'order_product')->first();
        $viewProductLanguagePermission = Permission::where('name', 'view_product_language')->first();
        $viewMoreProductPermission = Permission::where('name', 'view_more_product')->first();
        $commentProductPermission = Permission::where('name', 'comment_product')->first();

        // Gán permission cho user có level free
        foreach ($userFrees as $userFree) {
            $userFree->permissions()->attach($viewProductPermission);
        }
        // Gán permission cho user có level vip
        foreach ($userVips as $userVip) {
            $userVip->permissions()->attach($viewProductPermission);
            $userVip->permissions()->attach($viewProfilePermission);
            $userVip->permissions()->attach($viewListCategoryPermission);
            $userVip->permissions()->attach($orderProductPermission);
            $userVip->permissions()->attach($commentProductPermission);
        }
        // Gán permission cho user có level v-vip
        foreach ($userVVips as $userVVip) {
            $userVVip->permissions()->attach($viewProductPermission);
            $userVVip->permissions()->attach($viewProfilePermission);
            $userVVip->permissions()->attach($viewListCategoryPermission);
            $userVVip->permissions()->attach($orderProductPermission);
            $userVVip->permissions()->attach($commentProductPermission);
            $userVVip->permissions()->attach($viewProductLanguagePermission);
        }
        // Gán permission cho user có level s-vip
        foreach ($userSVips as $userSVip) {
            $userSVip->permissions()->attach($viewProductPermission);
            $userSVip->permissions()->attach($viewProfilePermission);
            $userSVip->permissions()->attach($viewListCategoryPermission);
            $userSVip->permissions()->attach($orderProductPermission);
            $userSVip->permissions()->attach($commentProductPermission);
            $userSVip->permissions()->attach($viewProductLanguagePermission);
            $userSVip->permissions()->attach($viewMoreProductPermission);
        }

    }
}
