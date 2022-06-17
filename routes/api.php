<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::prefix('v1/test')->group(function() {

    Route::controller(TestController::class)->group(function() {
        Route::get('/countries', 'getCountries');
        Route::get('/currencies', 'getCurrencies');
        Route::post('/import/countries', 'importContentFromCountriesFile');
        Route::post('/import/currencies', 'importContentFromCurrenciesFile');
    });
});
