<?php

namespace Tests\Feature;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyApiTest extends TestCase
{
    use RefreshDatabase;

    // setUp method to prepare data before tests run
    protected function setUp(): void
    {
        parent::setUp();
        // Create sample data using the Factory (or you can create manually)
        // This example creates 30 records with the conditions for_sale = true and sold = false
        Property::factory()->count(30)->create([
            'for_sale' => true,
            'sold' => false,
        ]);
    }

    // Test that pagination returns 25 properties per page
    public function test_pagination_returns_25_properties_per_page()
    {
        $response = $this->getJson('/api/properties?page=1');
        $response->assertStatus(200);
        $this->assertCount(25, $response->json('data'));
    }

    // Test search functionality using title and province
    public function test_search_functionality_by_title_and_province()
    {
        // Create a sample property with a unique title and specific province
        Property::create([
            'title' => 'Unique Title',
            'description' => 'Test property',
            'for_sale' => true,
            'for_rent' => false,
            'sold' => false,
            'price' => 500000,
            'currency' => 'THB',
            'currency_symbol' => '฿',
            'property_type' => 'Condo',
            'bedrooms' => 2,
            'bathrooms' => 2,
            'area' => 80,
            'area_type' => 'sqm',
            'geo' => ['country' => 'Thailand', 'province' => 'TestProvince', 'street' => 'Test Street'],
            'photos' => ['thumb' => '', 'search' => '', 'full' => ''],
        ]);

        // Searching with the keyword "Unique" should find this property
        $response = $this->getJson('/api/properties?search=Unique');
        $response->assertStatus(200);
        $this->assertNotEmpty($response->json('data'));
    }

    // Test sorting functionality by price
    public function test_sorting_by_price()
    {
        $response = $this->getJson('/api/properties?sort=price&order=desc');
        $response->assertStatus(200);
        $data = $response->json('data');

        // Verify that the first record's price is greater than or equal to the second record's price
        $this->assertGreaterThanOrEqual($data[1]['price'], $data[0]['price']);
    }
}
