<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (($open = fopen(storage_path() . '/app/files/01-Currencies.csv', 'r')) !== false) {

            while(($data = fgetcsv($open, 1000, ',')) !== false) {

                $content[] = $data;
            }

            $header = $content[0];

            for ($i = 1; $i < count($content); $i++) {

                Currency::create([
                    'iso_code' => $content[$i][0],
                    'iso_numeric_code' => $content[$i][1],
                    'common_name' => $content[$i][2],
                    'official_name' => $content[$i][3],
                    'symbol' => utf8_encode($content[$i][4]),
                ]);

            }

            fclose($open);
        }
    }
}
