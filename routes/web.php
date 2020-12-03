<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('drug_store.index');
});

Route::get('shop/{category}/{slug}', ['as' => 'product', 'uses' => 'drugStore\productController@myConstruct']);
Route::get('shop/{slug?}', ['as' => 'dr_category', 'uses' => 'drugStore\categoryController@show']);
Route::get('cart', 'drugStore\cartController@show');
Route::post('cart', 'drugStore\cartController@add');
Route::put('cart', 'drugStore\cartController@update');

Route::middleware(['login'])->group(function () {
	Route::get('ورود', 'userController@show');
	Route::post('ورود', 'userController@mobileChecker');
	Route::get('ثبت-نام', 'userController@registerShow');
	Route::post('ثبت-نام', 'userController@activation');
	Route::get('رمز-ورود', 'userController@passShow');
	Route::post('رمز-ورود', 'userController@login');
	Route::get('فراموشی-رمز', 'userController@forgetShow');
	Route::post('فراموشی-رمز', 'userController@forget');
});
Route::middleware(['mustLogin:0'])->group(function () {
	Route::get('خروج', 'userController@quit');
	Route::get('address', 'drugStore\addressController@show');
	Route::post('address', 'drugStore\addressController@insert');
	Route::get('new-address', 'drugStore\addressController@addNew');
	Route::post('finalize-order', 'drugStore\finalizeController@show');
});

Route::middleware(['origin'])->group(function () {
	Route::post('drug-store/set-score', 'drugStore\communityController@setScore');
	Route::post('drug-store/set-comment', 'drugStore\communityController@setComment');
});

Route::get('admin', function () {
    return view('admin.omid');
});

Route::get('admin/media-library', 'admin\mediaLibraryController@show')->middleware('mustLogin:1-2');
Route::get('admin/menu-management', 'admin\menuController@show')->middleware('mustLogin:1-2');
Route::post('admin/menu-management', 'admin\menuController@save')->middleware('mustLogin:1-2');
Route::get('admin/menu-details/{id?}', 'admin\menuController@meta')->middleware('mustLogin:1-2');
Route::post('admin/menu-details/{id}', 'admin\menuController@insertMeta')->middleware('mustLogin:1-2');
Route::get('admin/drug-store/tags', 'admin\drugStore\tagController@show')->middleware('mustLogin:1-2');
Route::post('admin/drug-store/tags', 'admin\drugStore\tagController@insert')->middleware('mustLogin:1-2');
Route::get('admin/drug-store/brands', 'admin\drugStore\brandController@show')->middleware('mustLogin:1-2');
Route::post('admin/drug-store/brands', 'admin\drugStore\brandController@insert')->middleware('mustLogin:1-2');
Route::get('admin/drug-store/taste', 'admin\drugStore\tasteController@show')->middleware('mustLogin:1-2');
Route::post('admin/drug-store/taste', 'admin\drugStore\tasteController@insert')->middleware('mustLogin:1-2');
Route::get('admin/drug-store/add-product', 'admin\drugStore\addProductController@show_dr')->middleware('mustLogin:1-2');
Route::post('admin/drug-store/add-product', 'admin\drugStore\addProductController@insert_dr')->middleware('mustLogin:1-2');
Route::get('admin/drug-store/add-product/{pid}', 'admin\drugStore\addProductController@show_dr2')->middleware('mustLogin:1-2');
Route::post('admin/drug-store/add-product/{pid}', 'admin\drugStore\addProductController@insert_dr2')->middleware('mustLogin:1-2');
Route::get('admin/drug-store/comments', 'admin\drugStore\commentController@show')->middleware('mustLogin:1-2');
Route::get('admin/drug-store/comments/{id}', 'admin\drugStore\commentController@show_cm')->middleware('mustLogin:1-2');
Route::post('admin/drug-store/comments/{id}', 'admin\drugStore\commentController@update')->middleware('mustLogin:1-2');
