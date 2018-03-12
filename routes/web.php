<?php

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

Auth::routes();

/*
|--------------------------------------------------------------------------
| Website (client side) routes
|--------------------------------------------------------------------------
|
| There is the routes of the website (client side)
|
*/

Route::get('/', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Dashboard (super admin) routes
|--------------------------------------------------------------------------
|
| There is the routes of the dashboard (only accessible by the super admin)
|
*/

Route::group(['middleware' => 'can:accessAdminpanelAdmins'], function() {
    // Admins list
    Route::get('/dashboard/admins', 'Adminpanel\Dashboard@indexAdmins')->name('indexDashboardAdmins');
    // Create an admin
    Route::post('/dashboard/admins', 'Adminpanel\Dashboard@createAdmin')->name('createAdmin');
    // Edit an admin
    Route::post('/dashboard/admins/{id}/edit', 'Adminpanel\Dashboard@editAdmin')->name('editAdmin');
    // Delete an admin
    Route::get('/dashboard/admins/{id}/delete', 'Adminpanel\Dashboard@deleteAdmin')->name('deleteAdmin');
});

/*
|--------------------------------------------------------------------------
| Dashboard (admin) routes
|--------------------------------------------------------------------------
|
| There is the routes of the dashboard (only accessible by admins and super admin)
|
*/

Route::group(['middleware' => 'can:accessAdminpanel'], function() {
    Route::get('/dashboard', 'Adminpanel\Dashboard@indexDashboard')->name('indexDashboard');
    Route::get('/dashboard/companies', 'Adminpanel\Dashboard@indexCompanies')->name('indexDashboardCompanies');
    // future adminpanel routes also should belong to the group
});