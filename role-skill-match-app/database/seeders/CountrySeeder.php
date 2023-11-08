<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 5 countries using model
        Country::create([
            'country_id' => 1,
            'country' => 'Singapore',
        ]);
        Country::create([
            'country_id' => 2,
            'country' => 'Malaysia',
        ]);
        Country::create([
            'country_id' => 3,
            'country' => 'Indonesia',
        ]);
        Country::create([
            'country_id' => 4,
            'country' => 'Thailand',
        ]);
        Country::create([
            'country_id' => 5,
            'country' => 'Vietnam',
        ]);
    }
}
