<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Donation;
use App\Models\User;

class DonationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Donation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->word,
            'christian_name' => $this->faker->word,
            'amount' => $this->faker->numberBetween(-10000, 10000),
            'completed' => $this->faker->numberBetween(-10000, 10000),
            'created_by_id' => User::factory(),
        ];
    }
}
