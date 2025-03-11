<?php

// database/seeders/PropertySeeder.php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PropertySeeder extends Seeder
{
    public function run()
    {
        $jsonPath = storage_path('app/properties.json');
        $jsonData = File::get($jsonPath);
        $properties = json_decode($jsonData, true);

        foreach ($properties as $data) {
            Property::create($data);
        }
    }
}
