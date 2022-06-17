<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (($open = fopen(storage_path() . '/app/files/02-Countries.csv', 'r')) !== false) {

            while(($data = fgetcsv($open, 1000, ',')) !== false) {

                $content[] = $data;
            }

            $header = $content[0];

            for ($i = 1; $i < count($content); $i++) {

                Country::create([
                    'continent_code' => $content[$i][0],
                    'currency_code' => $content[$i][1],
                    'iso2_code' => $content[$i][2],
                    'iso3_code' => $content[$i][3],
                    'iso_numeric_code' => $content[$i][4],
                    'fips_code' => $content[$i][5],
                    'calling_code' => $content[$i][6],
                    'common_name' => $content[$i][7],
                    'official_name' => utf8_encode($content[$i][8]),
                    'endonym' => utf8_encode($content[$i][9]),
                    'demonym' => utf8_encode($content[$i][10]),
                ]);

            }

            fclose($open);
        }
    }
}
