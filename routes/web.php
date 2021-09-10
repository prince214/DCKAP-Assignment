<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\CountriesAndCityController;

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
    return view('welcome');
});


Auth::routes();

Route::get('/google', [SocialLoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/google/callback', [SocialLoginController::class, 'googleCallback'])->name('google.callback');


Route::resource('users', UserController::class);
Route::get('/getCities/{cid}', [CountriesAndCityController::class, 'getCities'])->name('get.cities');
