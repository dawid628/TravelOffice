<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CountryController;
use \App\Http\Controllers\CityController;
use \App\Http\Controllers\TravelController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name("index"); // ->middleware('can:isUser')

Route::get('create-country', [CountryController::class, 'create']);
Route::post('store-country', [CountryController::class, 'store'])->name('store-country');
Route::get('countries', [CountryController::class, 'index']);

Route::get('create-city', [CityController::class, 'create'])->name('create-city');
Route::post('store-city', [CityController::class, 'store'])->name('store-city');
Route::get('cities', [CityController::class, 'index']);

Route::post('store-travel', [TravelController::class, 'store'])->name('store-travel');
Route::get('travels', [TravelController::class, 'index']);

Route::get('create-travel', [TravelController::class, 'create']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
