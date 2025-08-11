<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Rank;
use Illuminate\Console\Command;

class InitializeUserRanks extends Command
{
    protected $signature = 'users:initialize-ranks';
    protected $description = 'Initialize ranks for users who don\'t have one';

    public function handle()
    {
        $this->info('Initializing user ranks...');

        $firstRank = Rank::orderBy('required_exp')->first();
        if (!$firstRank) {
            $this->error('No ranks found in the database. Please run database seeders first.');
            return 1;
        }

        $users = User::whereDoesntHave('ranks')->get();
        $count = 0;

        foreach ($users as $user) {
            $user->ranks()->attach($firstRank->id, [
                'current_exp' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $count++;
        }

        $this->info("Successfully initialized ranks for {$count} users.");
        return 0;
    }
}
