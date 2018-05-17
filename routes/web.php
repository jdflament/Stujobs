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

// Email verification
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

/*
|--------------------------------------------------------------------------
| Website routes
|--------------------------------------------------------------------------
|
| There is the routes of the website (client side)
|
*/

/*
 * Website Pages
 */

// Show the homepage
Route::get('/', 'Website\HomeController@index')->name('home');
// Show an offer
Route::get('/offers/{id}', 'Website\OffersController@showValid')->name('showValidOffer');
// Apply to an offer
Route::post('/offers/{id}/apply', 'Website\AppliesController@apply')->name('applyOffer');
// Search offer
Route::get('/offers/search/{result}', 'Website\OffersController@search')->name('searchOffer');
// Filter offer
Route::post('/offers/filter/result', 'Website\OffersController@filterOffers')->name('filterOffers');
// Filter offers by company and checkboxes
Route::get('/offers/company/name', 'Website\OffersController@searchByCompany')->name('searchByCompany');
// Show an offer
Route::get('/companies/{id}', 'Website\CompaniesController@show')->name('showCompany');
// Get Newsletter data
Route::post('/newsletter/email', 'Website\NewsletterController@getEmail')->name('getNewsletterEmail');


/*
 * Company : Profile manager
 */

Route::group(['middleware' => 'can:companyAccess'], function() {
    // Profile index page
    Route::get('/profile', 'Website\ProfileController@index')->name('indexProfile');
    // Display Edit Page
    Route::get('/profile/edit', 'Website\ProfileController@editPage')->name('editProfilePage');
    // Edit Informations
    Route::post('/profile/edit', 'Website\ProfileController@edit')->name('editProfile');
    // Change Password
    Route::post('/profile/password/update', 'Website\ProfileController@changePassword')->name('profileUpdatePassword');
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
    // Complete an offer
    Route::get('/profile/offers/{id}/complete', 'Website\OffersController@complete')->name('completeOffer');
    // Uncomplete an offer
    Route::get('/profile/offers/{id}/uncomplete', 'Website\OffersController@uncomplete')->name('uncompleteOffer');
    // Edit offer page
    Route::get('/profile/offers/{id}/edit', 'Website\OffersController@editPage')->name('editOfferPage');
    // Edit an offer
    Route::post('/profile/offers/{id}/edit', 'Website\OffersController@edit')->name('editOffer');
    // Delete an offer
    Route::get('/profile/offers/{id}/delete', 'Website\OffersController@delete')->name('deleteOffer');
    // Show an offer
    Route::get('/profile/offers/{id}/show', 'Website\OffersController@show')->name('showOffer');
});

/*
 * Company : Applies manager
 */

Route::group(['middleware' => 'can:companyAccess'], function() {
    // Applies (of a company) index page
    Route::get('/profile/applies', 'Website\AppliesController@index')->name('indexApplies');
    // Show an apply
    Route::get('/profile/applies/{id}/show', 'Website\AppliesController@show')->name('showApply');
    // Filter the applies
    Route::get('/profile/applies/filter/{id}', 'Website\AppliesController@filter')->name('filterApplies');
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
 * Dashboard manager
 */

Route::group(['middleware' => 'can:allAdminsAccess'], function() {
    // Access to the dashboard homepage
    Route::get('/dashboard', 'Dashboard\HomeController@index')->name('dashboardIndex');
    // Get different offers contracts type
    Route::get('/dashboard/offers/contracttype', 'Dashboard\HomeController@contractType')->name('dashboardContractType');
    // Get informations of offers
    Route::get('/dashboard/offers/informations', 'Dashboard\HomeController@offersInformations')->name('dashboardOffersInformations');
    // Get offers rates
    Route::get('/dashboard/offers/rates', 'Dashboard\HomeController@offersRates')->name('dashboardOffersRates');
    // Get informations of applies
    Route::get('/dashboard/applies/informations', 'Dashboard\HomeController@appliesInformations')->name('dashboardAppliesInformations');
    // Get offers rates
    Route::get('/dashboard/applies/rates', 'Dashboard\HomeController@appliesRates')->name('dashboardAppliesRates');
});

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
 * Profile manager
 */

Route::group(['middleware' => 'can:allAdminsAccess'], function() {
    // Profile index page
    Route::get('/dashboard/profile', 'Dashboard\ProfileController@index')->name('dashboardIndexProfile');
    // Display Edit Page    
    Route::get('/dashboard/profile/edit', 'Dashboard\ProfileController@editPage')->name('dashboardEditProfilePage');
    // Edit Informations        
    Route::post('/dashboard/profile/edit', 'Dashboard\ProfileController@edit')->name('dashboardEditProfile');
    // Change Password            
    Route::post('/dashboard/profile/password/update', 'Dashboard\ProfileController@changePassword')->name('dashboardProfileUpdatePassword');
});

/*
 * Offers manager
 */

Route::group(['middleware' => 'can:allAdminsAccess'], function() {
    // Offers list
    Route::get('/dashboard/offers', 'Dashboard\OffersController@index')->name('dashboardIndexOffers');
    // Create offer page
    Route::get('/dashboard/offers/create', 'Dashboard\OffersController@createPage')->name('dashboardCreateOfferPage');
    // Create an offer
    Route::post('/dashboard/offers', 'Dashboard\OffersController@create')->name('dashboardCreateOffer');
    // Approve an offer
    Route::get('/dashboard/offers/{id}/approve', 'Dashboard\OffersController@approve')->name('dashboardApproveOffer');
    // Disapprove an offer
    Route::get('/dashboard/offers/{id}/disapprove', 'Dashboard\OffersController@disapprove')->name('dashboardDisapproveOffer');
    // Edit offer page
    Route::get('/dashboard/offers/{id}/edit', 'Dashboard\OffersController@editPage')->name('dashboardEditOfferPage');
    // Edit an offer
    Route::post('/dashboard/offers/{id}/edit', 'Dashboard\OffersController@edit')->name('dashboardEditOffer');
    // Delete an offer
    Route::get('/dashboard/offers/{id}/delete', 'Dashboard\OffersController@delete')->name('dashboardDeleteOffer');
    // Show an offer
    Route::get('/dashboard/offers/{id}/show', 'Dashboard\OffersController@show')->name('dashboardShowOffer');
    // Filter an offer
    Route::get('/dashboard/offers/filter/{type}', 'Dashboard\OffersController@filter')->name('dashboardFilterOffers');
});

/*
 * Applies manager
 */

Route::group(['middleware' => 'can:allAdminsAccess'], function() {
    // Applies list
    Route::get('/dashboard/applies', 'Dashboard\AppliesController@index')->name('dashboardIndexApplies');
    // Delete an apply
    Route::get('/dashboard/applies/{id}/delete', 'Dashboard\AppliesController@delete')->name('dashboardDeleteApply');
    // Show an apply
    Route::get('/dashboard/applies/{id}/show', 'Dashboard\AppliesController@show')->name('dashboardShowApply');
    // Refuse an apply
    Route::get('/dashboard/applies/{id}/refuse', 'Dashboard\AppliesController@refuse')->name('dashboardRefuseApply');
    // Accept an apply
    Route::get('/dashboard/applies/{id}/accept', 'Dashboard\AppliesController@accept')->name('dashboardAcceptApply');
    // Filter the applies
    Route::get('/dashboard/applies/filter/{id}', 'Dashboard\AppliesController@filter')->name('dashboardFilterApplies');
});

/*
 * Legals
 */
Route::get('/legals', 'Website\LegalsController@index')->name('legals');