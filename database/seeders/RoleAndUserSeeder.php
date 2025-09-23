<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RoleAndUserSeeder extends Seeder
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

        DB::transaction(function () {
            // 1. Buat Roles
            $adminRole = Role::create(['name' => 'admin']);
            $managerRole = Role::create(['name' => 'manager']);
            $staffRole = Role::create(['name' => 'staff']);

            // 2. Buat Users dan berikan Role
            // User Admin
            $admin = User::create([
                'name' => 'Admin Stockify',
                'email' => 'admin@stockify.com',
                'password' => Hash::make('password'), // Ganti 'password' dengan password aman
            ]);
            $admin->assignRole($adminRole);

            // User Manajer Gudang
            $manager = User::create([
                'name' => 'Manajer Gudang',
                'email' => 'manager@stockify.com',
                'password' => Hash::make('password'),
            ]);
            $manager->assignRole($managerRole);

            // User Staff Gudang
            $staff = User::create([
                'name' => 'Staff Gudang',
                'email' => 'staff@stockify.com',
                'password' => Hash::make('password'),
            ]);
            $staff->assignRole($staffRole);
        });
    }
}
