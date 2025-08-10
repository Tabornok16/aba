<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetDevelopmentPasswords extends Command
{
    protected $signature = 'dev:reset-passwords';
    protected $description = 'Reset all user passwords to development default (12345678)';

    public function handle()
    {
        if (!app()->environment('local', 'development')) {
            $this->error('This command can only be run in local or development environment!');
            return 1;
        }

        $this->info('Starting password reset for all users...');

        $count = User::query()->update([
            'password' => Hash::make('12345678')
        ]);

        $this->info("Successfully reset passwords for {$count} users to '12345678'");
        
        return 0;
    }
}
