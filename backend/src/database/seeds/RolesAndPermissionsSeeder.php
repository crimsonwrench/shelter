<?php

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
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'CreatePublications']);
        Permission::create(['name' => 'EditPublications']);
        Permission::create(['name' => 'DeletePublications']);
        Permission::create(['name' => 'StickThreads']);
        Permission::create(['name' => 'ChangeThreadStatus']);
        Permission::create(['name' => 'AssignRoles']);
        Permission::create(['name' => 'BanUsers']);
        Permission::create(['name' => 'CreateBoards']);

        // create roles and assign created permissions
        $role = Role::create(['name' => 'user'])
            ->givePermissionTo([
                'CreatePublications',
            ]);

        $role = Role::create(['name' => 'moderator'])
            ->givePermissionTo([
                'CreatePublications',
                'EditPublications',
                'DeletePublications',
                'StickThreads',
                'ChangeThreadStatus',
                'BanUsers',
            ]);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}
