<?php

namespace Database\Seeders;

use App\Permission;
use App\Role;
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
        $super_permissions = Permission::all()->sortByDesc("created_at");
        Role::findOrFail(1)->permissions()->sync($super_permissions->pluck('id'));

        $admin_permissions = $super_permissions->filter(function ($permission) {
            return substr($permission->label_permission, 0, 5) != 'user_'
                && substr($permission->label_permission, 0, 5) != 'role_'
                && substr($permission->label_permission, 0, 11) != 'permission_'
                && substr($permission->label_permission, 0, 8) != 'facture_';
        });
        Role::findOrFail(2)->permissions()->sync($admin_permissions);

        $user_permissions = $super_permissions->filter(function ($permission) {
            return substr($permission->label_permission, 0, 5) != 'user_'
                && substr($permission->label_permission, 0, 5) != 'role_'
                && substr($permission->label_permission, 0, 11) != 'permission_'
                && substr($permission->label_permission, 0, 7) != 'client_'
                && substr($permission->label_permission, 0, 9) != 'category_'
                && substr($permission->label_permission, 0, 8) != 'service_';
        });
        Role::findOrFail(3)->permissions()->sync($user_permissions);
    }
}
