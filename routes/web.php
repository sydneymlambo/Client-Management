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
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ClientRemarksController;
use App\Http\Controllers\BranchesController;

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

//DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::post('/dashboard', [DashboardController::class, 'store']);
Route::delete('/dashboard/{reminder}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');

//LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'store']);

//REGISTER
Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('auth');
Route::post('/register', [RegisterController::class, 'store']);

//LOGOUT
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//CLIENTS
Route::get('/clients', [ClientsController::class, 'index'])->name('clients')->middleware('auth');
Route::post('/clients', [ClientsController::class, 'store']);

//COMPANIES
Route::get('/companies', [CompaniesController::class, 'index'])->name('companies')->middleware('auth');
Route::post('/companies', [CompaniesController::class, 'store']);
Route::delete('/companies/{company}', [CompaniesController::class, 'destroy'])->name('companies.destroy');
Route::get('companies/{company}', [CompaniesController::class, 'show'])->name('companies.company')->middleware('auth');
Route::get('companies/edit/{id}', [CompaniesController::class, 'edit'])->middleware('auth');
Route::post('/update', [CompaniesController::class, 'update']);

//BRANCHES
Route::post('/companies/branch', [BranchesController::class, 'store']);
Route::delete('/branches/{branch}', [BranchesController::class, 'destroy'])->name('branches.destroy');

//USER
Route::get('/profile', [UserProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::get('users/edit/{id}', [UserProfileController::class, 'edit']);
Route::post('/update/user', [UserProfileController::class, 'update']);
Route::get('/users', [UserProfileController::class, 'view'])->name('users')->middleware('auth');
Route::delete('/users/{user}', [UserProfileController::class, 'destroy'])->name('users.destroy');

//PAYMENTS
Route::get('/payments', [PaymentsController::class, 'index'])->name('payments')->middleware('auth');
Route::post('/payments', [PaymentsController::class, 'store']);
Route::delete('/payments/{payment}', [PaymentsController::class, 'destroy'])->name('payments.destroy');

//DOCUMENTS
Route::get('/document-repository', [DocumentsController::class, 'index'])->name('document-repository')->middleware('auth');
Route::post('/document-repository', [DocumentsController::class, 'store']);
Route::get('/download/{document}', [DocumentsController::class, 'download']);

//INVOICES
Route::get('/invoices', [InvoicesController::class, 'index'])->name('invoices')->middleware('auth');
Route::post('/invoices', [InvoicesController::class, 'store']);
Route::get('invoices/{invoice}', [InvoicesController::class, 'show'])->name('invoices.invoice')->middleware('auth');
Route::post('/invoices/storeservice', [InvoicesController::class, 'storeService']);

//Client Remarks
Route::get('/client-remarks', [ClientRemarksController::class, 'index'])->name('clients-remarks')->middleware('auth');
Route::post('/client-remarks', [ClientRemarksController::class, 'store']);
Route::delete('/client-remarks/{cutomerRemark}', [ClientRemarksController::class, 'destroy'])->name('cutomerRemark.destroy');
