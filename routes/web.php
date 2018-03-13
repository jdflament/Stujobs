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
| Website routes
|--------------------------------------------------------------------------
|
| There is the routes of the website (client side)
|
*/

/*
 * Website Homepage
 */

Route::get('/', 'Website\HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Company manager routes
|--------------------------------------------------------------------------
|
| There is the routes of the website (client side)
|
*/

/*
 * Profile
 */

Route::group(['middleware' => 'can:companyAccess'], function() {
    // Profile index page
    Route::get('/profile', 'Website\ProfileController@index')->name('indexProfile');
});

/*
 * Offer
 */

Route::group(['middleware' => 'can:companyAccess'], function() {
    // Offer (of a company) index page
    Route::get('/profile/offers', 'Website\OffersController@index')->name('indexOffers');
    // Offer creation page
    Route::get('/offer/create', 'Website\OffersController@createPage')->name('createOfferPage');
});

// Create a job offer
Route::post('/offer/create', 'Website\OffersController@create')->name('createOffer');

/*
|--------------------------------------------------------------------------
| HomeController (super admin) routes
|--------------------------------------------------------------------------
|
| There is the routes of the dashboard (only accessible by the super admin)
|
*/

/*
 * Administrators manager
 */

Route::group(['middleware' => 'can:superAdminAccess'], function() {
    // AdminsController list
    Route::get('/dashboard/admins', 'Dashboard\AdminsController@index')->name('indexAdmins');
    // Create an admin
    Route::post('/dashboard/admins', 'Dashboard\AdminsController@create')->name('createAdmin');
    // Edit an admin
    Route::post('/dashboard/admins/{id}/edit', 'Dashboard\AdminsController@edit')->name('editAdmin');
    // Delete an admin
    Route::get('/dashboard/admins/{id}/delete', 'Dashboard\AdminsController@delete')->name('deleteAdmin');
    // Show an admin
    Route::get('/dashboard/admins/{id}/show', 'Dashboard\AdminsController@show')->name('showAdmin');
});

/*
|--------------------------------------------------------------------------
| HomeController (admin) routes
|--------------------------------------------------------------------------
|
| There is the routes of the dashboard (only accessible by admins and super admin)
|
*/

/*
 * CompaniesController manager
 */

Route::group(['middleware' => 'can:allAdminsAccess'], function() {
    // CompaniesController list
    Route::get('/dashboard/companies', 'Dashboard\CompaniesController@index')->name('indexCompanies');
    // Create a company
    Route::post('/dashboard/companies', 'Dashboard\CompaniesController@create')->name('createCompany');
    // Edit a company
    Route::post('/dashboard/companies/{id}/edit', 'Dashboard\CompaniesController@edit')->name('editCompany');
    // Delete a company
    Route::get('/dashboard/companies/{id}/delete', 'Dashboard\CompaniesController@delete')->name('deleteCompany');
    // Show a company
    Route::get('/dashboard/companies/{id}/show', 'Dashboard\CompaniesController@show')->name('showCompany');
});

/*
 * HomeController manager
 */

Route::group(['middleware' => 'can:allAdminsAccess'], function() {
    Route::get('/dashboard', 'Dashboard\HomeController@index')->name('indexDashboard');
});