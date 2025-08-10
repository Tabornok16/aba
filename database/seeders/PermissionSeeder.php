<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // User Management
            [
                'name' => 'View Users',
                'slug' => 'users.view',
                'description' => 'Can view user list and details'
            ],
            [
                'name' => 'Create Users',
                'slug' => 'users.create',
                'description' => 'Can create new users'
            ],
            [
                'name' => 'Edit Users',
                'slug' => 'users.edit',
                'description' => 'Can edit existing users'
            ],
            [
                'name' => 'Delete Users',
                'slug' => 'users.delete',
                'description' => 'Can delete users'
            ],
            
            // Role Management
            [
                'name' => 'View Roles',
                'slug' => 'roles.view',
                'description' => 'Can view roles and permissions'
            ],
            [
                'name' => 'Manage Roles',
                'slug' => 'roles.manage',
                'description' => 'Can create, edit, and delete roles'
            ],
            
            // System Settings
            [
                'name' => 'View Settings',
                'slug' => 'settings.view',
                'description' => 'Can view system settings'
            ],
            [
                'name' => 'Manage Settings',
                'slug' => 'settings.manage',
                'description' => 'Can modify system settings'
            ],
            
            // Reports
            [
                'name' => 'View Reports',
                'slug' => 'reports.view',
                'description' => 'Can view reports'
            ],
            [
                'name' => 'Generate Reports',
                'slug' => 'reports.generate',
                'description' => 'Can generate new reports'
            ],
            
            // Staff Management
            [
                'name' => 'View Staff',
                'slug' => 'staff.view',
                'description' => 'Can view staff members'
            ],
            [
                'name' => 'Manage Staff',
                'slug' => 'staff.manage',
                'description' => 'Can manage staff members'
            ]
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Assign permissions to roles
        $superAdmin = Role::where('slug', 'super-admin')->first();
        $adminManager = Role::where('slug', 'admin-manager')->first();
        $adminSupervisor = Role::where('slug', 'admin-supervisor')->first();
        $adminStaff = Role::where('slug', 'admin-staff')->first();

        // Super Admin gets all permissions
        $superAdmin->permissions()->attach(Permission::all());

        // Admin Manager permissions
        $managerPermissions = Permission::whereIn('slug', [
            'users.view', 'users.create', 'users.edit',
            'roles.view',
            'settings.view',
            'reports.view', 'reports.generate',
            'staff.view', 'staff.manage'
        ])->get();
        $adminManager->permissions()->attach($managerPermissions);

        // Admin Supervisor permissions
        $supervisorPermissions = Permission::whereIn('slug', [
            'users.view', 'users.create',
            'reports.view', 'reports.generate',
            'staff.view'
        ])->get();
        $adminSupervisor->permissions()->attach($supervisorPermissions);

        // Admin Staff permissions
        $staffPermissions = Permission::whereIn('slug', [
            'users.view',
            'reports.view',
            'staff.view'
        ])->get();
        $adminStaff->permissions()->attach($staffPermissions);
    }
}
