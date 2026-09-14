<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Package>
 */
class PackageFactory extends Factory
{
    public function definition(): array
    {
        $packages = [
            ['name' => 'Basic Package', 'price' => 500000],
            ['name' => 'Standard Package', 'price' => 850000],
            ['name' => 'Premium Package', 'price' => 1250000],
            ['name' => 'Deluxe Package', 'price' => 1750000],
        ];

        $package = fake()->unique()->randomElement($packages);

        return [
            'name' => $package['name'],
            'desc' => fake()->sentence(10),
            'price' => $package['price'],
        ];
    }
}
