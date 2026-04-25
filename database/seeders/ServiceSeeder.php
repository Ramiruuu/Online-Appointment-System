<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Service::create([
            'name' => 'General Consultation',
            'description' => 'A full general health consultation and personalized treatment plan.',
            'duration_minutes' => 30,
            'price' => 50.00,
            'is_active' => true,
        ]);

        Service::create([
            'name' => 'Dental Checkup',
            'description' => 'Comprehensive dental exam, cleaning, and oral health advice.',
            'duration_minutes' => 45,
            'price' => 80.00,
            'is_active' => true,
        ]);

        Service::create([
            'name' => 'Eye Exam',
            'description' => 'Vision screening, prescription check, and eye health assessment.',
            'duration_minutes' => 40,
            'price' => 70.00,
            'is_active' => true,
        ]);

        Service::create([
            'name' => 'Vaccination',
            'description' => 'Preventative vaccine administration with clinical follow-up.',
            'duration_minutes' => 20,
            'price' => 35.00,
            'is_active' => true,
        ]);
    }
}
