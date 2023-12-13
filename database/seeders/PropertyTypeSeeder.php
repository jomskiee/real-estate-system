<?php

namespace Database\Seeders;

use App\Models\PropertyTypes;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PropertyTypes::truncate();
        PropertyTypes::create(['prop_type'=> 'House']);
        PropertyTypes::create(['prop_type'=> 'House & Lot']);
        PropertyTypes::create(['prop_type'=> 'Lot']);
        PropertyTypes::create(['prop_type'=> 'Townhouse']);
        PropertyTypes::create(['prop_type'=> 'Villa']);
        PropertyTypes::create(['prop_type'=> 'Mansion']);
    }
}
