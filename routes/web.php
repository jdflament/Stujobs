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

Route::get('/', 'Website\HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Home (super admin) routes
|--------------------------------------------------------------------------
|
| There is the routes of the dashboard (only accessible by the super admin)
|
*/

/*
 * Administrators manager
 */

Route::group(['middleware' => 'can:superAdminAccess'], function() {
    // Admins list
    Route::get('/dashboard/admins', 'Dashboard\Admins@index')->name('indexAdmins');
    // Create an admin
    Route::post('/dashboard/admins', 'Dashboard\Admins@create')->name('createAdmin');
    // Edit an admin
    Route::post('/dashboard/admins/{id}/edit', 'Dashboard\Admins@edit')->name('editAdmin');
    // Delete an admin
    Route::get('/dashboard/admins/{id}/delete', 'Dashboard\Admins@delete')->name('deleteAdmin');
    // Show an admin
    Route::get('/dashboard/admins/{id}/show', 'Dashboard\Admins@show')->name('showAdmin');
});

/*
|--------------------------------------------------------------------------
| Home (admin) routes
|--------------------------------------------------------------------------
|
| There is the routes of the dashboard (only accessible by admins and super admin)
|
*/

/*
 * Companies manager
 */

Route::group(['middleware' => 'can:allAdminsAccess'], function() {
    // Companies list
    Route::get('/dashboard/companies', 'Dashboard\Companies@index')->name('indexCompanies');
    // Create a company
    Route::post('/dashboard/companies', 'Dashboard\Companies@create')->name('createCompany');
    // Edit a company
    Route::post('/dashboard/companies/{id}/edit', 'Dashboard\Companies@edit')->name('editCompany');
    // Delete a company
    Route::get('/dashboard/companies/{id}/delete', 'Dashboard\Companies@delete')->name('deleteCompany');
    // Show a company
    Route::get('/dashboard/companies/{id}/show', 'Dashboard\Companies@show')->name('showCompany');
});

/*
 * Home manager
 */

Route::group(['middleware' => 'can:allAdminsAccess'], function() {
    Route::get('/dashboard', 'Dashboard\Home@index')->name('indexDashboard');
});