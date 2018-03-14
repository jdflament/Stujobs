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
 * Company : Profile manager
 */

Route::group(['middleware' => 'can:companyAccess'], function() {
    // Profile index page
    Route::get('/profile', 'Website\ProfileController@index')->name('indexProfile');
});

/*
 * Company : Offers manager
 */

Route::group(['middleware' => 'can:companyAccess'], function() {
    // Offer (of a company) index page
    Route::get('/profile/offers', 'Website\OffersController@index')->name('indexOffers');
    // Offer creation page
    Route::get('/profile/offer/create', 'Website\OffersController@createPage')->name('createOfferPage');
    // Create a job offer
    Route::post('/profile/offer/create', 'Website\OffersController@create')->name('createOffer');
});

/*
|--------------------------------------------------------------------------
| Dashboard (super admin) routes
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
    Route::get('/dashboard/admins', 'Dashboard\AdminsController@index')->name('dashboardIndexAdmins');
    // Create an admin
    Route::post('/dashboard/admins', 'Dashboard\AdminsController@create')->name('dashboardCreateAdmin');
    // Edit an admin
    Route::post('/dashboard/admins/{id}/edit', 'Dashboard\AdminsController@edit')->name('dashboardEditAdmin');
    // Delete an admin
    Route::get('/dashboard/admins/{id}/delete', 'Dashboard\AdminsController@delete')->name('dashboardDeleteAdmin');
    // Show an admin
    Route::get('/dashboard/admins/{id}/show', 'Dashboard\AdminsController@show')->name('dashboardShowAdmin');
});

/*
|--------------------------------------------------------------------------
| Dashboard (all admins) routes
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
    Route::get('/dashboard/companies', 'Dashboard\CompaniesController@index')->name('dashboardIndexCompanies');
    // Create a company
    Route::post('/dashboard/companies', 'Dashboard\CompaniesController@create')->name('dashboardCreateCompany');
    // Edit a company
    Route::post('/dashboard/companies/{id}/edit', 'Dashboard\CompaniesController@edit')->name('dashboardEditCompany');
    // Delete a company
    Route::get('/dashboard/companies/{id}/delete', 'Dashboard\CompaniesController@delete')->name('dashboardDeleteCompany');
    // Show a company
    Route::get('/dashboard/companies/{id}/show', 'Dashboard\CompaniesController@show')->name('dashboardShowCompany');
});

/*
 * Offers manager
 */

Route::group(['middleware' => 'can:allAdminsAccess'], function() {
    // Offers list
    Route::get('/dashboard/offers', 'Dashboard\OffersController@index')->name('dashboardIndexOffers');
    // Create offer page
    Route::get('/dashboard/offers/create', 'Dashboard\OffersController@createPage')->name('dashboardCreateOfferPage');
//    // Create an offer
//    Route::post('/dashboard/offers', 'Dashboard\OffersController@create')->name('dashboardCreateOffer');
//    // Edit an offer
//    Route::post('/dashboard/offers/{id}/edit', 'Dashboard\OffersController@edit')->name('dashboardEditOffer');
//    // Delete an offer
//    Route::get('/dashboard/offers/{id}/delete', 'Dashboard\OffersController@delete')->name('dashboardDeleteOffer');
//    // Show an offer
//    Route::get('/dashboard/offers/{id}/show', 'Dashboard\OffersController@show')->name('dashboardShowOffer');
});

/*
 * HomeController manager
 */

Route::group(['middleware' => 'can:allAdminsAccess'], function() {
    Route::get('/dashboard', 'Dashboard\HomeController@index')->name('dashboardIndex');
});