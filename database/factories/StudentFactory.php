<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ClassRoom;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
   protected $model = Student::class;

    public function definition(): array
    {
        return [
            'class_room_id' => ClassRoom::inRandomOrder()->first()->id ?? ClassRoom::factory(),
            'name' => $this->faker->name(),
            'roll_no' => 'Roll-' . $this->faker->unique()->numberBetween(100, 999),
            'email' => $this->faker->unique()->safeEmail(),
            'dob' => $this->faker->date('Y-m-d', '-15 years'), 
        ];
    }
}
