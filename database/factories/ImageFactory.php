<?php

namespace Database\Factories;

use App\Models\Image;
use App\Services\Upload;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "path" => Upload::DEFAULT_IMAGE_PATH,
        ];
    }
}