<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        $badges = [
            [
                'name' => 'First Report',
                'description' => 'Submitted your first community report',
                'icon' => 'images/default-badge.svg',
                'required_reports' => 1,
                'required_points' => 0
            ],
            [
                'name' => 'Active Reporter',
                'description' => 'Submitted 5 verified reports',
                'icon' => 'images/default-badge.svg',
                'required_reports' => 5,
                'required_points' => 0
            ],
            [
                'name' => 'Point Collector',
                'description' => 'Earned 1000 points through community participation',
                'icon' => 'images/default-badge.svg',
                'required_reports' => 0,
                'required_points' => 1000
            ],
            [
                'name' => 'Community Expert',
                'description' => 'Earned 5000 points and submitted 20 verified reports',
                'icon' => 'images/default-badge.svg',
                'required_reports' => 20,
                'required_points' => 5000
            ]
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }
    }
}
