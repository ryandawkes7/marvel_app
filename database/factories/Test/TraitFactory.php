<?php

namespace Database\Factories\Test;

use App\Models\CharTrait;
use Illuminate\Database\Eloquent\Factories\Factory;

class TraitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CharTrait::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'description' => $this->faker->text(100)
        ];
    }
}
