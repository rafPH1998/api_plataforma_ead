<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;
use SebastianBergmann\LinesOfCode\Counter;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $model = Module::class;

    // while (count($user->categories) == 0) {
    //     $user = User::all()->random();
    // }

    public function definition()
    {
        return [
            'course_id' => Course::factory(),
            'name' => $this->faker->name()
        ];
    }
}
