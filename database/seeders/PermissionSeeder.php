<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [ 

            ['name' => 'company_access'],
            ['name' => 'company_create'],
            ['name' => 'company_edit'],
            ['name' => 'company_view'],
            ['name' => 'company_delete'],

            ['name' => 'employee_access'],
            ['name' => 'employee_create'],
            ['name' => 'employee_edit'],
            ['name' => 'employee_view'],
            ['name' => 'employee_delete'],

        ]; 

        $permissions = [];

        foreach($data as $permission){
            $permission['guard_name'] = 'web';
            $permission['created_at'] = Carbon::now();
            $permission['updated_at'] = Carbon::now();
            $permissions[] = $permission;
        }

        $data = Permission::insert($permissions);

        // Assign all permissions to ROLE Administrator

        $permission_ids = [];

        foreach(Permission::all() as $all_permission){
            $permission_ids[] = $all_permission->id;
        }

        // Assign permissions to ROLE Moderator and Editor
        $admin = Role::where('name', 'Admin')->first();
        $admin->syncPermissions($permission_ids);
    }
}
