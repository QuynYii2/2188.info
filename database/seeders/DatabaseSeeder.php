<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
//            UserSeeder::class,
//            CategorySeeder::class,
//            ProductSeeder::class,
//            RolesTableSeeder::class,
//            PermissionsSeeder::class,
            RoleUserSeeder::class,
            PermissionRoleSeeder::class,
        ]);

    }
}
