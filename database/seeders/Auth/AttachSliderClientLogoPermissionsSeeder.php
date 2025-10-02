<?php

namespace Database\Seeders\Auth;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class AttachSliderClientLogoPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Generate permissions for sliders and clientlogos using existing command
        Artisan::call('auth:permissions', ['name' => 'sliders']);
        Artisan::call('auth:permissions', ['name' => 'clientlogos']);

        // Assign to administrator role if exists
        $admin = Role::where('name', 'administrator')->first();
        if ($admin) {
            $admin->givePermissionTo([
                'view_sliders', 'add_sliders', 'edit_sliders', 'delete_sliders', 'restore_sliders',
                'view_clientlogos', 'add_clientlogos', 'edit_clientlogos', 'delete_clientlogos', 'restore_clientlogos',
            ]);
        }
    }
}




