<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lấy role super admin
        $superAdminRole = Role::where('name', 'superadmin')->first();

        // Lấy permission view_dashboard
        $viewDashboardPermission = Permission::where('name', 'view_dashboard')->first();

        // Gán permission view_dashboard cho role super admin
        if ($superAdminRole && $viewDashboardPermission) {
            $superAdminRole->permissions()->attach($viewDashboardPermission);
        }
    }
}
