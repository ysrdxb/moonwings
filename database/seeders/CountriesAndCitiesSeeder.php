<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesAndCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('seeders/countries.json'); // Adjusted path

        if (file_exists($jsonPath)) {
            $countriesData = json_decode(file_get_contents($jsonPath), true);

            foreach ($countriesData as $countryName => $cities) {
                $countryId = DB::table('countries')->insertGetId(['name' => $countryName]);

                $citiesData = array_map(function ($city) use ($countryId) {
                    return ['name' => $city, 'country_id' => $countryId];
                }, $cities);

                DB::table('cities')->insert($citiesData);
            }
        } else {
            $this->command->error("File not found: $jsonPath");
        }
    }
}
