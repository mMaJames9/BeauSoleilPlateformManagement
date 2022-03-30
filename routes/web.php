<?php

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

Route::redirect('/', '/login');

Auth::routes();

// Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['register' => false]);

// Admin
Route::group(['middleware' => ['auth']], function () {
    Route::redirect('/', '/login')->name('home');

    Route::resource('admin/management/categories', 'CategoryController');
    Route::resource('admin/management/clients', 'ClientController');
    Route::resource('admin/usermanagement/permissions', 'PermissionController');
    Route::resource('admin/usermanagement/roles', 'RoleController');
    Route::resource('admin/management/services', 'ServiceController');
    Route::resource('admin/management/invoices', 'ClientServiceController');
    Route::resource('admin/usermanagement/users', 'UserController');

});
