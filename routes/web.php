<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\RegisterClientController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\PaymentsController;

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

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::post('/dashboard', [DashboardController::class, 'store']);
Route::delete('/dashboard/{reminder}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('auth');
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/clients', [ClientsController::class, 'index'])->name('clients')->middleware('auth');
Route::post('/clients', [ClientsController::class, 'store']);


Route::get('/companies', [CompaniesController::class, 'index'])->name('companies')->middleware('auth');
Route::post('/companies', [CompaniesController::class, 'store']);
Route::delete('/companies/{company}', [CompaniesController::class, 'destroy'])->name('companies.destroy');
Route::get('companies/{company}', [CompaniesController::class, 'show'])->name('companies.company');

Route::get('/profile', [UserProfileController::class, 'index'])->name('profile')->middleware('auth');

Route::get('/payments', [PaymentsController::class, 'index'])->name('payments')->middleware('auth');
Route::post('/payments', [PaymentsController::class, 'store']);
