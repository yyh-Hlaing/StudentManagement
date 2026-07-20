<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\classroom;

class ClassRoomSeeder extends Seeder
{
   public function run(): void
    {
        $classes = [
            ['name' => 'Grade KG'],
            ['name' => 'Grade 1-A'],
            ['name' => 'Grade 1-B'],
            ['name' => 'Grade 2-A'],
            ['name' => 'Grade 2-B'],
            ['name' => 'Grade 3-A'],
            ['name' => 'Grade 3-B'],
            ['name' => 'Grade 4-A'],
            ['name' => 'Grade 4-B'],
            ['name' => 'Grade 5-A'],
            ['name' => 'Grade 5-B'],
            ['name' => 'Grade 6-A'],
            ['name' => 'Grade 6-B'],
            ['name' => 'Grade 7-A'],
            ['name' => 'Grade 7-B'],
            ['name' => 'Grade 8-A'],
            ['name' => 'Grade 8-B'],
            ['name' => 'Grade 9-A'],
            ['name' => 'Grade 9-B'],
            ['name' => 'Grade 10-A'],
            ['name' => 'Grade 10-B'],
            ['name' => 'Grade 11-A'],
            ['name' => 'Grade 11-B'],
            ['name' => 'Grade 12-A'],
            ['name' => 'Grade 12-B'],
        ];

        foreach ($classes as $class) {
            ClassRoom::create($class);
        }
    }
}
