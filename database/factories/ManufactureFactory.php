<?php

namespace Database\Factories;

use App\Models\Manufacture;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Manufacture>
 */
class ManufactureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $cititesIds = [129, 112, 31, 75, 135, 667];

        $name = $this->faker->jobTitle();

        $city = $this->faker->randomElement($cititesIds);

        return [
            'name' => $this->faker->jobTitle(),
            'description' => $this->faker->text(50),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'city_id' => $city,
            'website' => $this->faker->url(),
            'street' => $this->faker->streetAddress(),
            'building' => $this->faker->buildingNumber(),
            'postal_code' => $this->faker->postcode()
        ];
    }
}
