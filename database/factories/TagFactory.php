<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $TaskIDs = DB::table('tasks')->pluck('id');
        return [
            'tag_name' =>$this->faker->name,
            'task_id' => $this->faker->randomElement($TaskIDs)
        ];
    }
}
