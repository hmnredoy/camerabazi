<?php

use TunnelConflux\DevCrud\Helpers\DevCrudHelper;



//Redoy
Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
DevCrudHelper::setRoutes("location", "LocationController");
DevCrudHelper::setRoutes("skill", "SkillController");

Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::post('profile/edit', 'ProfileController@update')->name('profile.update');

//Route::get('job/{job}/bid', 'BidController@show')->name('bid.show');
Route::get('job/bid', 'BidController@show')->name('bid.show');
//Route::post('job/{job}/bid', 'BidController@store')->name('bid.store');
Route::post('job/{id}/bid', 'BidController@store')->name('bid.store');

Route::get('job/{id}/bids', 'BidController@all')->name('bid.all');

Route::get('job/{id}/bid/delete', 'BidController@delete')->name('bid.delete');




/*Route::namespace("Modules")->middleware('auth')->group(function () {

    DevCrudHelper::setRoutes('user', 'UserController');

});*/

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', ['middleware' =>'guest', function(){
    return redirect()->route('login');
}]);

Route::middleware('guest')->get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/jobs','JobController@index');
Route::post('/jobs','JobController@store');
Route::get('/jobs/create','JobController@create');
Route::get('/jobs/{job}','JobController@show');

//Route::get('/home', 'HomeController@index')->name('home');


//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/client/home', 'ClientController@home');
Route::get('/freelancer/home', 'FreelancerController@home');

