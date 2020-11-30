<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('shop/{category}/{product}', 'drugStore\productController@moreComments');

// Route::middleware(['optimizeImages'])->group(function () {
	Route::post('/upload/image/supplements/info', 'api\uploadImageController@supplementInfo');
	Route::post('/upload/image/categories', 'api\uploadImageController@categories');
// });
Route::middleware(['ajax'])->group(function () {
	Route::get('get-cities/{provinceid}', 'api\profileController@cities');
});	