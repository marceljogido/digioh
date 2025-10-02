<?php

namespace Database\Seeders\Auth;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->CreateDefaultPermissions();

        /**
         * Create Roles and Assign Permissions to Roles.
         */
        $super_admin = Role::firstOrCreate(['name' => 'super admin'], ['id' => '1']);

        $admin = Role::firstOrCreate(['name' => 'administrator'], ['id' => '2']);
        $admin->givePermissionTo(['view_backend', 'edit_settings']);

        $manager = Role::firstOrCreate(['name' => 'manager'], ['id' => '3']);
        $manager->givePermissionTo('view_backend');

        $executive = Role::firstOrCreate(['name' => 'executive'], ['id' => '4']);
        $executive->givePermissionTo('view_backend');

        $user = Role::firstOrCreate(['name' => 'user'], ['id' => '5']);
    }

    public function CreateDefaultPermissions()
    {
        // Create Permissions
        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        Artisan::call('auth:permissions', [
            'name' => 'posts',
        ]);
        echo "\n _Posts_ Permissions Created.";

        Artisan::call('auth:permissions', [
            'name' => 'categories',
        ]);
        echo "\n _Categories_ Permissions Created.";

        Artisan::call('auth:permissions', [
            'name' => 'tags',
        ]);
        echo "\n _Tags_ Permissions Created.";

        Artisan::call('auth:permissions', [
            'name' => 'comments',
        ]);
        echo "\n _Comments_ Permissions Created.";

        echo "\n\n";
    }
}
