<?php

use TunnelConflux\DevCrud\Helpers\DevCrudHelper;



Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
DevCrudHelper::setRoutes("location", "LocationController");
DevCrudHelper::setRoutes("skill", "SkillController");

Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::post('profile/edit', 'ProfileController@update')->name('profile.update');


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

