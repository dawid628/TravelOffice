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

Route::get('/', [TravelController::class, 'index'])->name('index');

// Kraje
Route::get('create-country', [CountryController::class, 'create'])->name('create-country');
Route::get('country/destroy/{id}', [CountryController::class, 'destroy']);
Route::post('store-country', [CountryController::class, 'store'])->name('store-country');
Route::get('countries', [CountryController::class, 'index']);
Route::get('/countries/{id}/edit', [CountryController::class, 'edit'])->name('edit-country');
Route::put('/countries/{id}', [CountryController::class, 'update'])->name('update-country');


// Miasta
Route::get('create-city', [CityController::class, 'create'])->name('create-city');
Route::post('store-city', [CityController::class, 'store'])->name('store-city');
Route::get('/cities/{id}/edit', [CityController::class, 'edit'])->name('edit-city');
Route::put('/cities/{id}', [CityController::class, 'update'])->name('update-city');

Route::get('cities', [CityController::class, 'index']);
Route::get('city/destroy/{id}', [CityController::class, 'destroy']);

// Podroze
Route::post('store-travel', [TravelController::class, 'store'])->name('store-travel');
Route::get('travels', [TravelController::class, 'index']);
Route::get('travel/destroy/{id}', [TravelController::class, 'destroy']);
Route::get('/travels/{id}/edit', [TravelController::class, 'edit'])->name('edit-travel');
Route::post('/travels/{id}', [TravelController::class, 'update'])->name('update-travel');

Route::get('create-travel', [TravelController::class, 'create'])->name('create-travel');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Panel administratora
Route::get('/management', [App\Http\Controllers\PanelController::class, 'index'])->name('management');
Route::get('/management/countries', [App\Http\Controllers\PanelController::class, 'countries'])->name('management_countries');
Route::get('/management/cities', [App\Http\Controllers\PanelController::class, 'cities'])->name('management_cities');
Route::get('/management/travels', [App\Http\Controllers\PanelController::class, 'travels'])->name('management_travels');
Route::get('/management/users', [App\Http\Controllers\UserController::class, 'index'])->name('management_users');
Route::post('/management/role/{userId}', [App\Http\Controllers\PanelController::class, 'changeRole'])->name('change-role');