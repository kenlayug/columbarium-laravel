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

Route::get('/additionals', function(){
	return view('additionalMaintenance');
});

Route::get('/blocks', function(){
	return view('blockMaintenance');
});

Route::get('/buy-units', function(){
	return view('reservationTransaction');
});

Route::get('/buildings', function(){
	return view('buildingMaintenance');
});

Route::get('/collection', function(){
	return view('collectionTransaction');
});

Route::get('/customers', function(){
	return view('customerTransaction');
});

Route::get('/floors', function(){
	return view('floorMaintenance');
});

Route::get('/interests', function(){
	return view('interestMaintenance');
});

Route::get('/manage-unit', function(){
	return view('manageUnitTransaction');
});

Route::get('/notification', function(){

});

Route::get('/packages', function(){
	return view('packageMaintenance');
});

Route::get('/requirements', function(){
	return view('requirementMaintenance');
});

Route::get('/schedule', function(){
	return view('scheduleTransaction');
});

Route::get('/services', function(){
	return view('serviceMaintenance');
});

Route::get('/units', function(){
	return view('unitMaintenance');
});

Route::group(['prefix' => 'api/v1'], function(){
	
	Route::resource('additionalcategory', 'AdditionalCategoryController');
	Route::resource('floortype', 'FloorTypeController');

	Route::group(['prefix' => 'additional'], function(){
		Route::get('/', 'AdditionalController@index');
		Route::post('/', 'AdditionalController@store');
		Route::get('/{id}/show', 'AdditionalController@show');
		Route::post('/{id}/update', 'AdditionalController@update');
		Route::post('/{id}/delete', 'AdditionalController@destroy');
		Route::get('/archive', 'AdditionalController@getDeactivated');
		Route::post('/{id}/enable', 'AdditionalController@reactivate');
	});

	Route::group(['prefix' => 'block'], function(){
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

	Route::group(['prefix' => 'building'], function(){
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

    Route::group(['prefix' => 'customer'], function(){
       Route::get('/', 'CustomerController@index');
        Route::post('/', 'CustomerController@store');
        Route::get('/{id}/show', 'CustomerController@show');
        Route::post('/{id}/update', 'CustomerController@update');
        Route::post('/{id}/delete', 'CustomerController@destroy');
        Route::get('/archive', 'CustomerController@getDeactivated');
        Route::post('/{id}/enable', 'CustomerController@enable');
    });

	Route::group(['prefix' => 'floor'], function(){
		Route::get('/{id}', 'FloorController@show');
		Route::post('/{id}/configure', 'FloorController@update');
		Route::get('/{id}/floortype', 'FloorController@showWithUnitType');
		Route::get('/{id}/block', 'FloorController@showBlocks');
	});

	Route::group(['prefix' => 'interest'], function(){
		Route::get('/', 'InterestController@index');
		Route::post('/', 'InterestController@store');
		Route::get('/{id}/show', 'InterestController@show');
		Route::post('/{id}/update', 'InterestController@update');
		Route::post('/{id}/delete', 'InterestController@destroy');
		Route::get('/archive', 'InterestController@getDeactivated');
		Route::post('/{id}/enable', 'InterestController@reactivate');
	});

	Route::group(['prefix' => 'package'], function(){
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

	Route::group(['prefix' => 'requirement'], function(){
		Route::get('/', 'RequirementController@index');
		Route::post('/', 'RequirementController@store');
		Route::get('/{id}/show', 'RequirementController@show');
		Route::post('/{id}/update', 'RequirementController@update');
		Route::post('/{id}/delete', 'RequirementController@destroy');
		Route::get('/archive', 'RequirementController@getAllDeactivated');
		Route::post('/{id}/enable', 'RequirementController@reactivate');
	});

	Route::group(['prefix' =>'service'], function(){
		Route::get('/', 'ServiceController@index');
		Route::post('/', 'ServiceController@store');
		Route::get('/{id}/show', 'ServiceController@show');
		Route::post('/{id}/update', 'ServiceController@update');
		Route::post('/{id}/delete', 'ServiceController@destroy');
		Route::get('/archive', 'ServiceController@getAllDeactivated');
		Route::post('/{id}/enable', 'ServiceController@reactivate');
		Route::get('{serviceId}/requirement', 'ServiceController@showRequirementOfService');
	});

	Route::group(['prefix' => 'unit'], function(){
		Route::get('/{id}/show', 'UnitController@show');
		Route::post('/{id}/delete', 'UnitController@destroy');
		Route::post('/{id}/enable', 'UnitController@reactivate');
	});

	Route::group(['prefix' => 'unitcategory'], function(){
		Route::get('/{id}/show', 'UnitCategoryController@show');
		Route::post('/{id}/update', 'UnitCategoryController@update');
	});

});
