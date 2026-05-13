<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ActivityType;

class ActivityTypesSeeder extends Seeder
{

    private $activityTypes = [
        'Physical',
        'Creative',
        'Social',
        'Educational',
        'Environmental',
        'Travel',
        'Leisure',
        'Entertainment',
        'Life Skills',
        'Wellbeing',
        'Vocational',
        'Community',
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->activityTypes as $type) {
            ActivityType::firstOrCreate(
                [
                    'name' => $type
                ]
            );
        }
    }
}
