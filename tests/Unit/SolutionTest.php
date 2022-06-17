<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Country;
use App\Models\Currency;
use Database\Seeders\CountryDatabaseSeeder;
use Database\Seeders\CurrencyDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SolutionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_database_data_created()
    {
        $this->seed([
            CurrencyDatabaseSeeder::class,
            CountryDatabaseSeeder::class,
        ]);

        $this->assertDatabaseHas('currencies', [
            'iso_code' => 'GBP'
        ]);
        $this->assertDatabaseHas('countries', [
            'continent_code' => 'AS'
        ]);
    }

    public function test_database_count()
    {
        $this->assertDatabaseCount('countries', 250);
        $this->assertDatabaseCount('currencies', 160);
    }

    public function test_country_exits()
    {
        $country = Country::factory()->create();

        $this->assertModelExists($country);
    }

    public function test_currency_exits()
    {
        $currency = Currency::factory()->create();

        $this->assertModelExists($currency);
    }

    public function test_delete_country_first()
    {
        $country = Country::factory()->create();

        $country = Country::first();

        if ($country) {
            $deleted = $country->delete();
        }

        $this->assertTrue($deleted);
    }

    public function test_countries_get_route()
    {
        $response = $this->get('/api/v1/test/countries');
        $response->assertStatus(200);
    }

    public function test_currencies_get_route()
    {
        $response = $this->get('/api/v1/test/currencies');
        $response->assertStatus(200);
    }

    public function test_currency_post_route()
    {
        $response = $this->post('/api/v1/test/import/currencies', [
            'currencies_file' => storage_path() . '/app/files/01-Currencies.csv'
        ]);

        $response->assertStatus(200);
    }
}
