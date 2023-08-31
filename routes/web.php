<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::any('/', [\App\Http\Controllers\IndexController::class,"check_route"]);
//
//Route::redirect("/login","/");
//Route::get("/send",[\App\Http\Controllers\IndexController::class,"test"]);
Route::any('/login', function(){

$curl = curl_init();

// Set the URL you want to send the GET request to
$url = 'https://syria-2ngel.com/';

// Set custom headers
$headers = array(
    'Authorization: Bearer YourAccessToken', // Replace with your actual authorization header
    
);

// Set curl options
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

// Execute the request
$response = curl_exec($curl);

// Check for errors
if (curl_errno($curl)) {
    echo 'Curl error: ' . curl_error($curl);
}

// Close the curl session
curl_close($curl);

// Process the response
if ($response) {
    echo $response;
} else {
    echo 'No response received.';
}

});
Route::get('/', function () {
 
    // The URL you want to send the request to
    $url = 'http://trip-getaway.epizy.com/index';
    
    // Create options for the stream context (optional)
    $options = [
        'http' => [
            'method' => 'GET', // You can change this to 'POST', 'PUT', etc.
            'header' => 'Cookie: __test=e86d155bc6385a93706b3977a6ba8f3c; XSRF-TOKEN=eyJpdiI6IlovOUxBNnVoNEh3NUhnMmZ6T2hnNWc9PSIsInZhbHVlIjoiZC95SEhpV001cWRBSVJVRU5PaGNkMVFyM0NkODdoeHJIVFU1amdxT2hyVEc1YUpmSWg5bEZmRHZxUVd4aEFSM1VtcklXaERBYk1pVFFKQ3o2dnBtcDVoQk5sZ2QxZmRKSlBsWDh5aUFSZjh4dERYd3p3aCs0WDFxVDVqaFlUNy8iLCJtYWMiOiIzMzNjMTRmMzg3YmM0ZmYzOWZhZWNjMjM1NzFlOTM2MjlhZjdhNWZkNjczMDA2YzUzYTQ1NDI1Njg4NzQ5NDE0IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IjQ2MXFranhUeDRaMm1KUERTUzZFZHc9PSIsInZhbHVlIjoiYmFveE9xTjVwZnl5MkhXM1E2MFR1cDdCSkJ0MW1pdzVNTlBaQ1dQK1doNGlwdTNKV0VqM0lvZzBUNmFsN2lWbXlySG9pNlU5MnB2eExDYWl3Y3JKbTJYR0dTaDY5WVYvNUk5M0RuMUtZU3grbEhrTS82Z0d3c2NRWFR3Vzh5SnoiLCJtYWMiOiIwYjkxYTBmMDI0OTVmMzVhMDlhYTNlMDE4N2VhNDdhYTUxMWYzYTg4ZDAxZWUyOTYwMThlY2EyYmUzZTA2Y2E3IiwidGFnIjoiIn0%3D', // Set any headers you need
            'timeout' => 20, // Set a timeout value in seconds
        ],
    ];
    
    // Create a stream context with the options
    $context = stream_context_create($options);
    
    // Send the HTTP request and get the response
    $response = file_get_contents($url, false, $context);
    
    // Check if the request was successful
    if ($response !== false) {
        // Do something with the response
        echo $response;
    } else {
        // Handle the error
        echo "Error making the request";
    }
   
    
});

Route::get('/{page}', [AdminController::class,"index"]);
