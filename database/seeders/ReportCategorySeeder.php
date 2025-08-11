<?php

namespace Database\Seeders;

use App\Models\ReportCategory;
use Illuminate\Database\Seeder;

class ReportCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Kalamidad',
                'description' => 'Reports related to natural disasters and calamities',
                'icon' => 'images/default-category.svg'
            ],
            [
                'name' => 'Kaligtasang Pampubliko',
                'description' => 'Public safety and security concerns',
                'icon' => 'images/default-category.svg'
            ],
            [
                'name' => 'Isyung Pangkapaligiran',
                'description' => 'Environmental issues and concerns',
                'icon' => 'images/default-category.svg'
            ],
            [
                'name' => 'Sirang Pasilidad',
                'description' => 'Damaged public facilities and infrastructure',
                'icon' => 'images/default-category.svg'
            ],
            [
                'name' => 'Iba Pa',
                'description' => 'Other community concerns',
                'icon' => 'images/default-category.svg'
            ]
        ];

        foreach ($categories as $category) {
            ReportCategory::create($category);
        }
    }
}
