<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Currency;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
       // Get currencies data from database
       public function getCurrencies()
       {
           $pagination = request()->query('pagination');
           $search = request()->query('search');

           if ($pagination != null) {
               $currencies = Currency::paginate($pagination);
               return response()->json(['status' => 200, 'data' => $currencies]);
           }
           elseif ($search != null) {
               $currencies = Currency::where('common_name', Str::ucfirst($search))
                               ->orWhere('iso_code', Str::upper($search))->first();
               return response()->json(['status' => 200, 'data' => $currencies]);
           }
           else {
               $currencies = Currency::all();
               return response()->json(['status' => 200, 'data' => $currencies]);
           }
       }


    // Get countries data from database
    public function getCountries()
    {
        $pagination = request()->query('pagination');
        $search = request()->query('search');

        if ($pagination != null) {
            $countries = Country::paginate($pagination);
            return response()->json(['status' => 200, 'data' => $countries]);
        }
        elseif ($search != null) {
            $countries = Country::where('common_name', Str::title($search))
                        ->orWhere('currency_code', Str::upper($search))->first();
            return response()->json(['status' => 200, 'data' => $countries]);
        }
        else {
            $countries = Country::all();
            return response()->json(['status' => 200, 'data' => $countries]);
        }
    }



     // Importing content from currencies csv file into a database
     public function importContentFromCurrenciesCsvFile(Request $request)
     {
         $validated = Validator::make($request->all(), [
             'currencies_file' => 'required|file'
         ]);

         if ($validated->fails()) {
             return response()->json(['status' => 400, 'message' => $validated->messages()]);
         }
         else {
             $fileExtension = $request->file('currencies_file')->getClientOriginalExtension();

             if ($fileExtension === 'csv') {

                 if (($open = fopen($request->file('currencies_file'), 'r')) !== false) {

                     while(($data = fgetcsv($open, 1000, ',')) !== false) {

                         $content[] = $data;
                     }

                     $header = $content[0];


                     try {
                             for ($i = 1; $i < count($content); $i++) {

                                 Currency::create([
                                     'iso_code' => $content[$i][0],
                                     'iso_numeric_code' => $content[$i][1],
                                     'common_name' => $content[$i][2],
                                     'official_name' => $content[$i][3],
                                     'symbol' => $content[$i][4],
                                 ]);

                             }

                         } catch (QueryException $e) {

                             return response()->json(['status' => 500, 'message' => $e->getMessage()]);
                         }

                     $request->file('currencies_file')->storeAs('files', $request->file('currencies_file')->getClientOriginalName());

                     return response()->json(['status' => 200, 'message' => 'File content imported.']);

                     fclose($open);
                 }
             }
             else {
                 return response()->json(['status' => 200, 'message' => 'File not a csv format.']);
             }

         }
     }




    // Importing content from countries csv file into a database
    public function importContentFromCountriesCsvFile(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'countries_file' => 'required|file'
        ]);

        if ($validated->fails()) {
            return response()->json(['status' => 400, 'message' => $validated->messages()]);
        }
        else {
            $fileExtension = $request->file('countries_file')->getClientOriginalExtension();

            if ($fileExtension === 'csv') {

                if (($open = fopen($request->file('countries_file'), 'r')) !== false) {

                    while(($data = fgetcsv($open, 1000, ',')) !== false) {

                        $content[] = $data;
                    }

                    $header = $content[0];


                    try {
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
                                    'official_name' => $content[$i][8],
                                    'endonym' => $content[$i][9],
                                    'demonym' => $content[$i][10],
                                ]);
                            }

                        } catch (QueryException $e) {

                            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
                        }

                    $request->file('countries_file')->storeAs('files', $request->file('countries_file')->getClientOriginalName());

                    return response()->json(['status' => 200, 'message' => 'File content imported.']);

                    fclose($open);
                }
            }
            else {
                return response()->json(['status' => 200, 'message' => 'File not a csv format.']);
            }
        }
    }


}
