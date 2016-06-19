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

Route::get('interests', 'PageController\InterestPageController@pageUp');

Route::group(['prefix' => 'api'], function(){


    //Api version 1
    Route::group(['prefix' => 'v1'], function(){

        Route::resource('additionalcategories', 'AdditionalCategoryController');
        Route::resource('floortypes', 'FloorTypeController');

        Route::group(['prefix' => 'additionals'], function(){
            Route::get('/', 'AdditionalController@index');
            Route::post('/', 'AdditionalController@store');
            Route::get('/{id}/show', 'AdditionalController@show');
            Route::post('/{id}/update', 'AdditionalController@update');
            Route::post('/{id}/delete', 'AdditionalController@destroy');
            Route::get('/archive', 'AdditionalController@getDeactivated');
            Route::post('/{id}/enable', 'AdditionalController@reactivate');
        });

        Route::group(['prefix' => 'blocks'], function(){
            Route::get('/', 'BlockController@index');
            Route::post('/', 'BlockController@store');
            Route::get('/{id}/show', 'BlockController@show');
            Route::post('/{id}/update', 'BlockController@update');
            Route::post('/{id}/delete', 'BlockController@destroy');
            Route::get('/archive', 'BlockController@getDeactivated');
            Route::post('/{id}/enable', 'BlockController@reactivate');
            Route::get('/{id}/unit', 'BlockController@getBlockUnits');
            Route::get('/{id}/unitcategory', 'BlockController@getBlockUnitCategory');
            Route::get('/{id}/unitCategory', 'BlockController@getBlockUnitCategoryDetail');
        });

        Route::group(['prefix' => 'buildings'], function(){
            Route::get('/', 'BuildingController@index');
            Route::post('/', 'BuildingController@store');
            Route::get('/{id}/show', 'BuildingController@show');
            Route::post('/{id}/update', 'BuildingController@update');
            Route::post('/{id}/delete', 'BuildingController@destroy');
            Route::get('/archive', 'BuildingController@getDeactivated');
            Route::post('/{id}/enable', 'BuildingController@reactivate');
            Route::get('/floor', 'BuildingController@getAllBuildingFloor');
            Route::get('/{id}/floor', 'BuildingController@getBuildingFloor');
            Route::get('/{id}/floorBlock', 'BuildingController@getBuildingFloorWithBlock');
        });

        Route::group(['prefix' => 'customers'], function(){
           Route::get('/', 'CustomerController@index');
            Route::post('/', 'CustomerController@store');
            Route::get('/{id}/show', 'CustomerController@show');
            Route::post('/{id}/update', 'CustomerController@update');
            Route::post('/{id}/delete', 'CustomerController@destroy');
            Route::get('/archive', 'CustomerController@getDeactivated');
            Route::post('/{id}/enable', 'CustomerController@enable');
        });

        Route::group(['prefix' => 'floors'], function(){
            Route::get('/{id}', 'FloorController@show');
            Route::post('/{id}/configure', 'FloorController@update');
            Route::get('/{id}/floortype', 'FloorController@showWithUnitType');
            Route::get('/{id}/block', 'FloorController@showBlocks');
        });

        Route::group(['prefix' => 'interests'], function(){
            Route::get('/', 'InterestController@index');
            Route::post('/', 'InterestController@store');
            Route::get('/{id}/show', 'InterestController@show');
            Route::post('/{id}/update', 'InterestController@update');
            Route::post('/{id}/delete', 'InterestController@destroy');
            Route::get('/archive', 'InterestController@getDeactivated');
            Route::post('/{id}/enable', 'InterestController@reactivate');
        });

        Route::group(['prefix' => 'packages'], function(){
            Route::get('/', 'PackageController@index');
            Route::post('/', 'PackageController@store');
            Route::get('/{id}/show', 'PackageController@show');
            Route::post('/{id}/update', 'PackageController@update');
            Route::post('/{id}/delete', 'PackageController@destroy');
            Route::get('/archive', 'PackageController@getDeactivated');
            Route::post('/{id}/enable', 'PackageController@reactivate');
            Route::get('/{id}/additional', 'PackageController@getAdditionalOfPackage');
            Route::get('/{id}/service', 'PackageController@getServiceOfPackage');
        });

        Route::group(['prefix' => 'requirements'], function(){
            Route::get('/', 'RequirementController@index');
            Route::post('/', 'RequirementController@store');
            Route::get('/{id}/show', 'RequirementController@show');
            Route::post('/{id}/update', 'RequirementController@update');
            Route::post('/{id}/delete', 'RequirementController@destroy');
            Route::get('/archive', 'RequirementController@getAllDeactivated');
            Route::post('/{id}/enable', 'RequirementController@reactivate');
        });

        Route::group(['prefix' =>'services'], function(){
            Route::get('/', 'ServiceController@index');
            Route::post('/', 'ServiceController@store');
            Route::get('/{id}/show', 'ServiceController@show');
            Route::post('/{id}/update', 'ServiceController@update');
            Route::post('/{id}/delete', 'ServiceController@destroy');
            Route::get('/archive', 'ServiceController@getAllDeactivated');
            Route::post('/{id}/enable', 'ServiceController@reactivate');
            Route::get('{serviceId}/requirement', 'ServiceController@showRequirementOfService');
        });

        Route::group(['prefix' => 'units'], function(){
            Route::get('/{id}/info', 'UnitController@show');
            Route::post('/{id}/delete', 'UnitController@destroy');
            Route::post('/{id}/enable', 'UnitController@reactivate');
        });

        Route::group(['prefix' => 'unitcategories'], function(){
            Route::get('/{id}/show', 'UnitCategoryController@show');
            Route::post('/{id}/update', 'UnitCategoryController@update');
        });

    });

    //Api version 2
    Route::group(['prefix' => 'v2'], function(){

       Route::resource('blocks', 'Api\v2\BlockController');

    });

});
