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

    Route::get('/findPriceService', 'App\Http\Controllers\ClientServiceController@findPriceService');

    Route::resource('/admin/management/categories', 'App\Http\Controllers\CategoryController');
    Route::resource('/admin/management/clients', 'App\Http\Controllers\ClientController');
    Route::resource('/admin/usermanagement/permissions', 'App\Http\Controllers\PermissionController');
    Route::resource('/admin/usermanagement/roles', 'App\Http\Controllers\RoleController');
    Route::resource('/admin/management/services', 'App\Http\Controllers\ServiceController');
    Route::resource('/admin/management/tickets', 'App\Http\Controllers\ClientServiceController');
    Route::resource('/admin/usermanagement/users', 'App\Http\Controllers\UserController');

});
