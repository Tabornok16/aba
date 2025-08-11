<?php

namespace Database\Seeders;

use App\Models\Rank;
use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    public function run(): void
    {
        $ranks = [
            [
                'name' => 'Brave Citizen',
                'description' => 'Starting rank for all community members',
                'required_exp' => 0
            ],
            [
                'name' => 'Active Contributor',
                'description' => 'Actively participates in community activities',
                'required_exp' => 500
            ],
            [
                'name' => 'Community Guardian',
                'description' => 'Dedicated to protecting and improving the community',
                'required_exp' => 1500
            ],
            [
                'name' => 'Neighborhood Champion',
                'description' => 'A true champion of community development',
                'required_exp' => 3000
            ],
            [
                'name' => 'Community Leader',
                'description' => 'Leading by example in community service',
                'required_exp' => 6000
            ]
        ];

        foreach ($ranks as $rank) {
            Rank::create($rank);
        }
    }
}
