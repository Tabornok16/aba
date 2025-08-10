<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AgeGroupSeeder::class,
            PermissionSeeder::class,
        ]);

        // Create a super admin user
        $superAdminRole = \App\Models\Role::where('slug', 'super-admin')->first();
        $adultAgeGroup = \App\Models\AgeGroup::where('name', 'Adult')->first();

        // Create default admin users
        $defaultUsers = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => bcrypt('password'),
                'role_id' => $superAdminRole->id,
                'age_group_id' => $adultAgeGroup->id,
            ],
            [
                'name' => 'Admin Manager',
                'email' => 'manager@example.com',
                'password' => bcrypt('password'),
                'role_id' => \App\Models\Role::where('slug', 'admin-manager')->first()->id,
                'age_group_id' => $adultAgeGroup->id,
            ],
            [
                'name' => 'Admin Supervisor',
                'email' => 'supervisor@example.com',
                'password' => bcrypt('password'),
                'role_id' => \App\Models\Role::where('slug', 'admin-supervisor')->first()->id,
                'age_group_id' => $adultAgeGroup->id,
            ],
            [
                'name' => 'Admin Staff',
                'email' => 'staff@example.com',
                'password' => bcrypt('password'),
                'role_id' => \App\Models\Role::where('slug', 'admin-staff')->first()->id,
                'age_group_id' => $adultAgeGroup->id,
            ]
        ];

        foreach ($defaultUsers as $user) {
            User::create($user);
        }
    }
}
