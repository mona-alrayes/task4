<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/client', [App\Http\Controllers\ClientController::class, 'index'])->name('client');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('/admin/delete{id}', [App\Http\Controllers\AdminController::class, 'delete'])->name('delete');
Route::get('/admin/register', [App\Http\Controllers\AdminController::class, 'view_register'])->name('regsiter');
Route::post('/admin/register', [App\Http\Controllers\AdminController::class, 'store'])->name('regsiter');
Route::get('/admin/edit{id}', [App\Http\Controllers\AdminController::class, 'view_edit'])->name('edit');
Route::post('/admin/edit{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('edit');
Route::get('/admin/role{id}', [App\Http\Controllers\AdminController::class, 'role'])->name('role');
