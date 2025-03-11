<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'for_sale' => true,
            'for_rent' => false,
            'sold' => false,
            'price' => $this->faker->numberBetween(100000, 1000000),
            'currency' => 'THB',
            'currency_symbol' => '฿',
            'property_type' => $this->faker->randomElement(['Condo', 'Apartment', 'Villa']),
            'bedrooms' => $this->faker->numberBetween(1, 5),
            'bathrooms' => $this->faker->numberBetween(1, 3),
            'area' => $this->faker->numberBetween(50, 200),
            'area_type' => 'sqm',
            'geo' => [
                'country' => 'Thailand',
                'province' => $this->faker->randomElement(['Bangkok', 'Phuket', 'Samut Prakan']),
                'street' => $this->faker->streetAddress,
            ],
            'photos' => [
                'thumb' => 'https://placehold.co/150x100',
                'search' => 'https://placehold.co/300x150',
                'full' => 'https://placehold.co/600x300',
            ],
        ];
    }
}
