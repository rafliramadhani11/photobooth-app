<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' ' . fake()->randomElement(['Wedding', 'Birthday', 'Corporate Gathering', 'Graduation', 'Anniversary']),
            'desc' => fake()->optional(0.7)->sentence(12),
            'location' => fake()->optional(0.8)->city(),
            'event_date' => fake()->unique()->dateTimeBetween('-2 months', '+3 months')->format('Y-m-d'),
            'is_active' => fake()->boolean(70),
            'logo' => null,
        ];
    }

    public function active(): static
    {
        return $this->state(fn() => ['is_active' => true]);
    }

    public function inactive(): static
    {
        return $this->state(fn() => ['is_active' => false]);
    }
}
