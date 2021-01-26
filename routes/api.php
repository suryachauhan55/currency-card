<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Card API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your card. These routes
| are loaded by the ServiceProvider of your card. You're free to add
| as many additional routes to this file as your card may require.
|
*/

// Route::get('/endpoint', function (Request $request) {
//     //
// });

Route::get('/currency-convert/{base}/{to}', function ($base,$to) {
	$url = "https://api.exchangeratesapi.io/latest?base=$base&symbols=$to";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
    curl_setopt($ch, CURLOPT_TIMEOUT, 300);
    $output = curl_exec($ch);
    if (curl_errno($ch)) {
        return array();
    }
    curl_close($ch);
    $result = json_decode($output, true);
    $data = array();
    if(!empty($result['rates'])) {
	    foreach ($result['rates'] as $key => $value) {
	    	$data['name'] = $key;
	    	$data['rate'] = $value;
	    }
	}
	return response()->json($data);
});

// https://api.exchangeratesapi.io/latest?base=INR&symbols=USD
