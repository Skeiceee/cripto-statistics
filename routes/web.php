<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BitcoinDataController;

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
    return view('home');
});

Route::post('/bitcoin/data', [BitcoinDataController::class, 'getData'])->name('bitcoin.data');