<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AgeGroup;

class AgeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ageGroups = [
            [
                'name' => 'Child / Kid',
                'min_age' => 6,
                'max_age' => 12,
                'description' => '6–12 years'
            ],
            [
                'name' => 'Teenager / Adolescent',
                'min_age' => 13,
                'max_age' => 17,
                'description' => '13–17 years'
            ],
            [
                'name' => 'Young Adult',
                'min_age' => 18,
                'max_age' => 25,
                'description' => '18–25 years'
            ],
            [
                'name' => 'Adult',
                'min_age' => 26,
                'max_age' => 39,
                'description' => '26–39 years'
            ],
            [
                'name' => 'Middle-aged Adult',
                'min_age' => 40,
                'max_age' => 59,
                'description' => '40–59 years'
            ],
            [
                'name' => 'Senior / Elderly',
                'min_age' => 60,
                'max_age' => null,
                'description' => '60+ years'
            ]
        ];

        foreach ($ageGroups as $ageGroup) {
            AgeGroup::create($ageGroup);
        }
    }
}
