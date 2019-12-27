<?php

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
	return File::get($_SERVER["DOCUMENT_ROOT"] . '/index.html');
});

# catch all
Route::get('{any?}', function ($any = null) {
	return File::get($_SERVER["DOCUMENT_ROOT"] . '/index.html');
})->where('any', '.*');

