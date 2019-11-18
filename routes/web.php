<?php

use TunnelConflux\DevCrud\Helpers\DevCrudHelper;

//Redoy
Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
DevCrudHelper::setRoutes("location", "LocationController");
DevCrudHelper::setRoutes("skill_tool", "SkillToolController");
DevCrudHelper::setRoutes("membership-plan", "MembershipPlanController");
DevCrudHelper::setRoutes("user", "UserController");

Route::get('profile/{user}', 'ProfileController@show')->name('profile.show');
Route::get('profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
Route::post('profile/{user}/edit', 'ProfileController@update')->name('profile.update');


Route::get('client/offer/{bid}', 'ClientOfferController@index')->name('client.offer.index');
Route::post('client/offer/{bid}', 'ClientOfferController@store')->name('client.offer.store');

Route::get('freelancer/offer/{bid}', 'FreelancerOfferController@index')->name('freelancer.offer.index');
Route::post('freelancer/offer/{bid}', 'FreelancerOfferController@update')->name('freelancer.offer.decision');


Route::get('memberships', 'MembershipPlanController@showPlans')->name('membership.show');
Route::post('membership/{user}/{membershipPlan}', 'MembershipPurchaseController@buyMembership')->name('membership.buy');
//Route::post('profile/{user}/change-password', 'ProfileController@changePassword')->name('password.change');

Route::post('profile/{user}/edit/experience', 'ExperienceController@store')->name('experience.store');

Route::post('portfolio/add', 'PortfolioController@store')->name('portfolio.store');

//Freelancer Bid
Route::get('jobs/{job}/bid', 'BidController@show')->name('bid.show');
Route::post('jobs/{job}/bid', 'BidController@store')->name('bid.store');

Route::get('job/{id}/bids', 'BidController@all')->name('bid.all');

Route::get('job/{id}/bid/delete', 'BidController@delete')->name('bid.delete');//Make Delete Request


Route::get('job/{job}/review', 'ReviewController@show')->name('review.show');
Route::post('job/{job}/review', 'ReviewController@store')->name('review.store');
//Route::post('profile/edit/experience', 'ExperienceController@educationStore')->name('education.store');
//DevCrudHelper::setRoutes("experience", "ExperienceController");





/*Route::namespace("Modules")->middleware('auth')->group(function () {

    DevCrudHelper::setRoutes('user', 'UserController');

});*/

Auth::routes();


Route::get('/', ['middleware' =>'guest', function(){
    return redirect()->route('login');
}]);

Route::middleware('guest')->get('/', 'Auth\LoginController@showLoginForm')->name('login');
/*Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');*/
Route::get('/jobs','JobController@index');
Route::post('/jobs','JobController@store');
Route::get('/jobs/create','JobController@create');
Route::get('/jobs/{job}','JobController@show');


Route::get('/client/home', 'ClientController@home');
Route::get('/client/jobs', 'ClientController@myJobs');
Route::get('/client/jobs/{job}/bids', 'ClientController@jobBid');
Route::get('/freelancer/home', 'FreelancerController@home');

