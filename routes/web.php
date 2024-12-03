<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerBarang; 
use App\Http\Controllers\Controller; 

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
    return view('home');
})->name('home');

Route::get('/privacy-policy', function () {
    return view('privacy-policy'); // Buat halaman ini sesuai kebutuhan.
})->name('privacy.policy');