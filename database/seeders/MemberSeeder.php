<?php

namespace Database\Seeders;

use App\Enums\RegisterMember;
use App\Enums\RegisterMemberPrice;
use App\Models\Member;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionMember1 = Permission::where('name', 'find products')->first();
        $permissionMember2 = Permission::where('name', 'find partners transaction')->first();
        $permissionMember3 = Permission::where('name', 'display capacity at the product display section')->first();
        $permissionMember4 = Permission::where('name', 'send new product message')->first();
        $permissionMember5 = Permission::where('name', 'send messages to promote new products')->first();
        $permissionMember6 = Permission::where('name', 'provide order program')->first();
        $permissionMember7 = Permission::where('name', 'display accessories and supplies')->first();
        $permissionMember8 = Permission::where('name', 'put on dedicated display')->first();

        $list1 = $permissionMember1->id . ',' . $permissionMember2->id . ',' . $permissionMember3->id;
        $list2 = $list1 . ',' . $permissionMember4->id;
        $list3 = $list2 . ',' . $permissionMember5->id;
        $list4 = $list3 . ',' . $permissionMember6->id;
        $list5 = $list4 . ',' . $permissionMember7->id;
        $list6 = $list5 . ',' . $permissionMember8->id;
        $members = [
            [
                'user_id' => 1,
                'name' => RegisterMember::TRUST,
                'price' => 0,
                'permission_id' => $list1,
            ],
            [
                'user_id' => 1,
                'name' => RegisterMember::LOGISTIC,
                'price' => 0,
                'permission_id' => $list2,
            ],
            [
                'user_id' => 1,
                'name' => RegisterMember::VENDOR,
                'price' => RegisterMemberPrice::VENDOR,
                'permission_id' => $list3,
            ],
            [
                'user_id' => 1,
                'name' => RegisterMember::POWER_VENDOR,
                'price' => RegisterMemberPrice::POWER_VENDOR,
                'permission_id' => $list4,
            ],
            [
                'user_id' => 1,
                'name' => RegisterMember::PRODUCTION,
                'price' => RegisterMemberPrice::PRODUCTION,
                'permission_id' => $list6,
            ],
            [
                'user_id' => 1,
                'name' => RegisterMember::POWER_PRODUCTION,
                'price' => RegisterMemberPrice::POWER_PRODUCTION,
                'permission_id' => $list6,
            ],
        ];

        Member::insert($members);
    }
}
