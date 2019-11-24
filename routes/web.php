<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use TunnelConflux\DevCrud\Helpers\DevCrudHelper;


//Redoy
Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
DevCrudHelper::setRoutes("location", "LocationController");
DevCrudHelper::setRoutes("skill_tool", "SkillToolController");
DevCrudHelper::setRoutes("membership-plan", "MembershipPlanController");
DevCrudHelper::setRoutes("user", "UserController");

Route::middleware('auth')->group(function () {
    Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::patch('profile/edit', 'ProfileController@update')->name('profile.update');
    Route::post('profile/edit/experience', 'ExperienceController@store')->name('experience.store');
    Route::get('profile/{user}', 'ProfileController@show')->name('profile.show');
});


Route::get('freelancer/dashboard', 'DashboardController@freelancer')->name('freelancer.dashboard');
Route::get('client/dashboard', 'DashboardController@client')->name('client.dashboard');

Route::get('client/offer/{bid}', 'ClientOfferController@index')->name('client.offer.index');
Route::post('client/offer/{bid}', 'ClientOfferController@store')->name('client.offer.store');

Route::get('freelancer/offer/{bid}', 'FreelancerOfferController@index')->name('freelancer.offer.index');
Route::post('freelancer/offer/{bid}', 'FreelancerOfferController@update')->name('freelancer.offer.decision');


Route::get('memberships', 'MembershipPlanController@showPlans')->name('membership.show');
Route::post('membership/{membershipPlan}', 'MembershipPurchaseController@buyMembership')->name('membership.buy');
//Route::post('profile/{user}/change-password', 'ProfileController@changePassword')->name('password.change');


Route::post('portfolio/add', 'PortfolioController@store')->name('portfolio.store');

//Freelancer Bid
Route::get('jobs/{job}/bid', 'BidController@show')->name('bid.show');
Route::post('jobs/{job}/cancel', 'JobController@cancel')->name('job.cancel');
Route::post('jobs/{job}/bid', 'BidController@store')->name('bid.store');
Route::post('jobs/{job}/bids/{bid}/approved', 'BidController@approved');
Route::post('jobs/{job}/bids/{bid}/cancel', 'BidController@cancel');
Route::post('jobs/{job}/bids/{bid}/succeeded', 'BidController@succeeded');

Route::get('job/{id}/bids', 'BidController@all')->name('bid.all');

Route::get('job/{id}/bid/delete', 'BidController@delete')->name('bid.delete');
Route::post('profile/edit/experience', 'ExperienceController@companyStore')->name('experience.store');

Route::get('job/{job}/review', 'ReviewController@show')->name('review.show');
Route::post('job/{job}/review', 'ReviewController@store')->name('review.store');


Route::middleware('guest')->get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/jobs','JobController@index');
Route::post('/jobs','JobController@store');
Route::get('/jobs/create','JobController@create');
Route::get('/jobs/{job}','JobController@show');
Route::get('/search/','JobController@search');


Route::get('/client/home', 'ClientController@home');
Route::get('/client/ongoing-jobs', 'ClientController@ongoingJobs');
Route::get('/client/submitted-jobs', 'ClientController@submittedJobs');
Route::get('/client/cancelled-jobs', 'ClientController@canceledJobs');
Route::get('/client/jobs/{job}/proposals', 'ClientController@jobProposal');

Route::get('/freelancer/home', 'FreelancerController@home');
Route::get('/freelancer/proposed-jobs', 'FreelancerController@proposedJobs');
Route::get('/freelancer/active-jobs', 'FreelancerController@activeBids');
Route::get('/freelancer/ongoing-jobs', 'FreelancerController@ongoingBids');


//Auth::routes();
