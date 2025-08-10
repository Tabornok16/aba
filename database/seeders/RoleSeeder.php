<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'description' => 'System Administrator with full access'
            ],
            [
                'name' => 'Admin Manager',
                'slug' => 'admin-manager',
                'description' => 'Administrative Manager with high-level access'
            ],
            [
                'name' => 'Admin Supervisor',
                'slug' => 'admin-supervisor',
                'description' => 'Administrative Supervisor with moderate access'
            ],
            [
                'name' => 'Admin Staff',
                'slug' => 'admin-staff',
                'description' => 'Administrative Staff with basic access'
            ],
            [
                'name' => 'Resident',
                'slug' => 'resident',
                'description' => 'Regular resident user'
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
