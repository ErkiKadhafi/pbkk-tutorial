<?php

use App\Http\Controllers\CacheController;
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

Route::get('/', [CacheController::class, 'getAllCacheKeys'])->name("cache/index");
Route::post('/cache/key', [CacheController::class, 'addNewKey'])->name("cache/post");
Route::delete('/cache/delete/all', [CacheController::class, 'deleteAll'])->name("cache/deleteAll");
Route::delete('/cache/{key}', [CacheController::class, 'deleteKey'])->name("cache/delete");
Route::put('/cache/{key}', [CacheController::class, 'pullKey'])->name("cache/pull");

