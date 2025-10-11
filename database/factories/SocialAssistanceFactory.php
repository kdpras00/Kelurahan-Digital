<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SocialAssistance>
 */
class SocialAssistanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'thumbnail'    => $this->faker->imageUrl(),
            'name'         => $this->faker->randomElement(['Bantuan Pangan', 'Bantuan tunai', 'Bansos Pendidikan', 'Bansos Kesehatan']) . ' ' . $this->faker->company,
            'category'     => $this->faker->randomElement(['staple', 'cash', 'subsidized fuel', 'health']),
            'amount'       => $this->faker->randomFloat(2, 1000, 10000),
            'provider'     => $this->faker->company,
            'description'  => $this->faker->sentence,
            'is_available' => $this->faker->boolean(),
        ];
    }
}
