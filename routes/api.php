<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->namespace('\App\Http\Controllers\API')->group(function () {
    Route::get('/me', 'TMRController@getDetails')->name('tmr.getDetails');
    Route::get('/me/visits', 'TMRController@getVisitLists')->name('tmr.getVisitLists');
    Route::get('/attendance', 'AttendanceController@getAttendance')->name('attendance.getDetails');
    Route::post('/attendance/check-in', 'AttendanceController@checkIn')->name('attendance.checkIn');
    Route::post('/attendance/check-out', 'AttendanceController@checkOut')->name('attendance.checkOut');
    Route::get('/routes', 'RouteController@listItems')->name('route.listItems');
    Route::get('/outlets/{route?}', 'OutletController@listItems')->name('outlet.listItems');
    Route::get('/outlet/{textId}/details', 'OutletController@getDetails')->name('outlet.getDetails');
    Route::post('/outlet/{outlet}/update', 'OutletController@updateDetails')->name('outlet.updateDetails');
    Route::get('/notices', 'NoticeController@listItems')->name('notice.listItems');

    Route::post('/feedback', 'FeedbackController@store')->name('feedback.new');
    Route::post('/visit/{outlet}', 'VisitController@store')->name('outlet.visit');
    Route::post('/visit/{visit}/competitors', 'VisitController@storeCompetitors')->name('outlet.visit.storeCompetitors');
    Route::get('/visit/{visit}/details', 'VisitController@getDetails')->name('outlet.visit.getDetails');
    Route::get('/campaigns', 'CampaignController@getListItems')->name('outlet.listItems');
    Route::get('/competitors', 'BrandController@competitors')->name('brand.competitors');
    Route::post('/survey/submit', 'SurveyController@store')->name('survey.store');
});

Route::get('/survey', 'API\SurveyController@index');