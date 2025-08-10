<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create {--type=super : The type of admin user to create (super/manager)}';
    protected $description = 'Create a new admin user (super admin or admin manager)';

    public function handle()
    {
        $type = $this->option('type');
        
        if (!in_array($type, ['super', 'manager'])) {
            $this->error('Invalid admin type. Use either "super" or "manager".');
            return 1;
        }

        $email = $this->ask('Enter admin email');
        $name = $this->ask('Enter admin name');
        $password = $this->secret('Enter admin password');
        $password_confirmation = $this->secret('Confirm admin password');
        $mobile = $this->ask('Enter mobile number');

        // Validate input
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password_confirmation,
            'mobile_number' => $mobile,
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobile_number' => ['required', 'string', 'unique:users'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        // Create user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'mobile_number' => $mobile,
            'email_verified_at' => now(),
            'is_verified' => true,
        ]);

        // Assign role
        $role = Role::where('slug', $type === 'super' ? 'super-admin' : 'admin-manager')->first();
        if (!$role) {
            $this->error('Required role not found. Please run role seeder first.');
            return 1;
        }
        
        $user->role()->associate($role);
        $user->save();

        $this->info('Admin user created successfully!');
        $this->table(
            ['Name', 'Email', 'Role'],
            [[$user->name, $user->email, $role->name]]
        );

        return 0;
    }
}
