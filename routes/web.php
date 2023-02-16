<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\UserController;

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
    return view('index');
});
Route::get('/pepito', function () {
    return view('welcome');
});
Route::get('login', function () {
    return view('welcome');
});

Route::get('/prueba', [PruebaController::class, 'prueba']);

Route::get('/api/register', [UserController::class, 'register']);




