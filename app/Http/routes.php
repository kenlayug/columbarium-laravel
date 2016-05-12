<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('child');
});

Route::get('/test', function(){
	return view('additionalMaintenance');
});

Route::get('/additional', function(){
	return view('additionalMaintenance');
});

Route::get('/requirements', function(){
	return view('requirementMaintenance');
});

Route::get('/services', function(){
	return view('serviceMaintenance');
});

Route::group(['prefix' => 'api/v1'], function(){
	Route::resource('additionalcategory', 'AdditionalCategoryController');
	Route::resource('additional', 'AdditionalController');
	Route::resource('service', 'ServiceController');
	Route::resource('requirement', 'RequirementController');
});
