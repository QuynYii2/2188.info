<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lấy ra các role và user mẫu
        $superAdminRole = Role::where('name', 'super_admin')->first();
        $sellerRole = Role::where('name', 'seller')->first();
        $buyerRole = Role::where('name', 'buyer')->first();

        $superAdmin = User::where('email', 'khacquyit93@gmail.com')->first();
        $seller = User::where('email', 'kienhue98@gmail.com')->first();
        $buyer = User::where('email', 'upacocha@example.com')->first();

        // Gán role cho user
        $superAdmin->roles()->attach($superAdminRole);
        $seller->roles()->attach($seller);
        $buyer->roles()->attach($buyer);
    }
}
