<?php

use App\Http\Controllers\Calendar\IndexController as Calendar;
use App\Http\Controllers\Event\StoreController as StoreEvents;
use App\Http\Controllers\Event\UpdateController as UpdateEvents;
use App\Http\Controllers\Session\Destroy as Logout;
use App\Http\Controllers\Session\StoreController as StoreSession;
use App\Http\Controllers\Settings\IndexController as Settings;
use App\Http\Controllers\User\LoginController as Login;
use App\Http\Controllers\User\RegisterController as Register;
use App\Http\Controllers\User\StoreController as StoreUser;
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

Route::get('/', Calendar::class)->middleware('auth')->name('calendar.index');
Route::post('events', StoreEvents::class)->middleware('auth')->name('events.store');
Route::post('events/{event}', UpdateEvents::class)->middleware('auth')->name('events.update');

Route::get('settings', Settings::class)->middleware('auth')->name('settings.index');

Route::get('login', Login::class)->name('users.login');
Route::post('login', StoreSession::class)->name('sessions.create');
Route::get('register', Register::class)->name('users.register');
Route::post('register', StoreUser::class)->name('users.store');
Route::post('logout', Logout::class)->name('sessions.destroy');
