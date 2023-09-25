<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', \App\Http\Controllers\Calendar\IndexController::class)->name('calendar.index');
Route::post('events', \App\Http\Controllers\Event\StoreController::class)->name('events.store');
Route::post('events/{event}', \App\Http\Controllers\Event\UpdateController::class)->name('events.update');
