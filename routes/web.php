<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::redirect('/', '/login');

Auth::routes();

// Auth::routes(['register' => false]);

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Auth::routes(['register' => false]);

// Admin
Route::group(['middleware' => ['auth']], function () {
    Route::redirect('/', '/login')->name('home');

    Route::get('/category', 'App\Http\Controllers\CategoryController')->name('admin/management/categories');
    Route::get('/client', 'App\Http\Controllers\ClientController')->name('admin/management/clients');
    Route::get('/permission', 'App\Http\Controllers\PermissionController')->name('admin/management/permissions');
    Route::get('/role', 'App\Http\Controllers\RoleController')->name('admin/management/roles');
    Route::get('/service', 'App\Http\Controllers\ServiceController')->name('admin/management/services');
    Route::get('/ticket', 'App\Http\Controllers\ClientServiceController')->name('admin/management/tickets');
    Route::get('/user', 'App\Http\Controllers\UserController')->name('admin/management/users');

});
