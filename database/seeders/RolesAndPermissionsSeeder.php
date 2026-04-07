<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        \Spatie\Permission\Models\Role::create(['name' => 'admin']);
        \Spatie\Permission\Models\Role::create(['name' => 'provider']);
        \Spatie\Permission\Models\Role::create(['name' => 'customer']);

        $admin = \App\Models\User::create([
            'name'     => 'Admin',
            'email'    => 'admin@sevasl.lk',
            'password' => bcrypt('Admin@123'),
            'account_type' => 'admin',
        ]);
        $admin->assignRole('admin');
    }
}
