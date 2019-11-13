<?php

//use TunnelConflux\DevCrud\Helpers\DevCrudHelper;


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
Route::get('/jobs/{job}','JobController@show');
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/client/home', 'ClientController@home');
Route::get('/freelancer/home', 'FreelancerController@home');