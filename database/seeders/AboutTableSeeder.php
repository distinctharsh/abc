<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $abouts = [
            [
                'title' => 'Our Mission',
                'description' => 'We are dedicated to providing the highest quality dental care with a focus on patient comfort and satisfaction.',
                'image' => 'images/mission.jpg',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Expert Team',
                'description' => 'Our team of experienced dental professionals is committed to delivering exceptional care using the latest technology.',
                'image' => 'images/team.jpg',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Modern Facility',
                'description' => 'Our state-of-the-art facility is equipped with the latest dental technology to ensure the best care for our patients.',
                'image' => 'images/facility.jpg',
                'order' => 3,
                'is_active' => true,
            ]
        ];

        foreach ($abouts as $about) {
            \App\Models\About::create($about);
        }
    }
}
