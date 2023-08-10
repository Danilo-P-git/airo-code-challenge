<?php

namespace Database\Seeders;

use App\Models\AgeLoad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgeLoadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['min' => 18, 'max' => 30, 'load' => 0.6],
            ['min' => 31, 'max' => 40, 'load' => 0.7],
            ['min' => 41, 'max' => 50, 'load' => 0.8],
            ['min' => 51, 'max' => 60, 'load' => 0.9],
            ['min' => 61, 'max' => 70, 'load' => 1.0],
        ];

        foreach ($data as $ageLoad) {
            AgeLoad::insert($ageLoad);
        }
    }
}
