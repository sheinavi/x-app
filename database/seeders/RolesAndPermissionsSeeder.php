<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $permissions = [
            'create','approve'
        ];

        foreach($permissions as $permission){
            Permission::create(['name' => $permission]);
        }

        $admin_role = Role::create(['name' => 'admin']);
        $admin_role->syncPermissions($permissions);

        $creator_role = Role::create(['name' => 'creator']);
        $creator_role->givePermissionTo('create');

        $user_role = Role::create(['name' => 'user']);
    }
}