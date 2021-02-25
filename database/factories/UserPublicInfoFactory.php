<?php

namespace Database\Factories;

use App\Models\UserPublicInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserPublicInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserPublicInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->unique()->text(),
            'name' => $this->faker->name(),
            'bio' => $this->faker->paragraph(),
        ];
    }
}