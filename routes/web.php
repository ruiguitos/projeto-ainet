<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;



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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//CATALOGO
Route::view('/catalogo', 'catalogo.index');

//ADMIN DASHBOARD
Route::view('/dashboard', 'dashboard.index');
Route::view('/dashboard/charts', 'dashboard.charts');
Route::view('/dashboard/tables', 'dashboard.tables');

//PERFIL
Route::view('/perfil', 'perfil.index');
Route::get('/perfil/{customer}', [CustomerController::class, 'index'])->name('perfil.index');
Route::get('/perfil/{customer}/edit', [CustomerController::class, 'edit'])->name('perfil.edit');
Route::put('/perfil/{customer}', [CustomerController::class, 'update'])->name('perfil.update');
Route::delete('/perfil/{customer}', [CustomerController::class, 'destroy'])->name('perfil.destroy');
Route::delete('/perfil/{customer}/photo', [CustomerController::class, 'destroy_photo'])->name('perfil.photo.destroy');

//CHANGE PASSWORD
Route::view('/password/reset', 'auth.passwords.reset');

