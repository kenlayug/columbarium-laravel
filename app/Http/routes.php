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


Route::get('test', function(){
    return view('manageUnitTransaction');
});

Route::get('schedule', function(){
    return view('scheduleTransaction');
});

Route::get('buy-unit-transaction', function(){

    return view('reservationTransaction');

});
Route::get('login', function(){

    return view('v2.login');

});

Route::get('utilities', function(){

    return view('v2.utilities');

});
Route::get('downpayment-transaction',   'PageController\DownpaymentController@pageUp'       );

Route::get('customer-transaction',      'PageController\CustomerPageController@pageUp'      );
Route::get('collection-transaction',    'PageController\CollectionController@pageUp'     );

Route::get('interest-maintenance',      'PageController\InterestPageController@pageUp'      );
Route::get('additional-maintenance',    'PageController\AdditionalPageController@pageUp'    );
Route::get('requirement-maintenance',   'PageController\RequirementPageController@pageUp'   );
Route::get('service-maintenance',       'PageController\ServicePageController@pageUp'       );
Route::get('package-maintenance',       'PageController\PackagePageController@pageUp'       );
Route::get('building-maintenance',      'PageController\BuildingPageController@pageUp'      );
Route::get('floor-maintenance',         'PageController\FloorPageController@pageUp'         );
Route::get('room-maintenance',          'PageController\RoomPageController@pageUp'          );
Route::get('block-maintenance',         'PageController\BlockPageController@pageUp'         );
Route::get('price-maintenance',         'PageController\PricePageController@pageUp'         );

Route::get('employee-utility',          'PageController\EmployeePageController@pageUp'      );

Route::get('/pdf/sample', 'Pdf\SampleController@sample');

Route::group(['prefix'  =>  'pdf'], function(){

    Route::get('/reservations/{id}', 'Pdf\ReservationPdfController@generate');
    Route::get('/downpayments/{id}', 'Pdf\DownpaymentPdfController@generate');

});

Route::group(['prefix' => 'api'], function(){


    //Api version 1
    Route::group(['prefix' => 'v1'], function(){

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
            Route::get('/',                                 'BuildingController@index'                          );
            Route::post('/',                                'BuildingController@store'                          );
            Route::get('/{id}/show',                        'BuildingController@show'                           );
            Route::post('/{id}/update',                     'BuildingController@update'                         );
            Route::post('/{id}/delete',                     'BuildingController@destroy'                        );
            Route::get('/archive',                          'BuildingController@getDeactivated'                 );
            Route::post('/{id}/enable',                     'BuildingController@reactivate'                     );
            Route::get('/floor',                            'BuildingController@getAllBuildingFloor'            );
            Route::get('/{id}/floor',                       'BuildingController@getBuildingFloor'               );
            Route::get('/{id}/floorBlock',                  'BuildingController@getBuildingFloorWithBlock'      );
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

        Route::group(['prefix' => 'interests'], function(){
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
            Route::get('/{id}/info', 'UnitController@show');
            Route::post('/{id}/delete', 'UnitController@destroy');
            Route::post('/{id}/enable', 'UnitController@reactivate');
        });

        Route::group(['prefix' => 'unitcategory'], function(){
            Route::get('/{id}/show', 'UnitCategoryController@show');
            Route::post('/{id}/update', 'UnitCategoryController@update');
        });

    });

    //Api version 2
    Route::group(['prefix' => 'v2'], function(){

        Route::group(['prefix'  =>  'blocks'], function(){

            Route::get(         '/{id}/units',      'Api\v2\BlockController@getUnits'                           );

        });
        Route::resource(        'blocks',           'Api\v2\BlockController'                                    );

        Route::group(['prefix' => 'collections'], function(){

            Route::get('/{id}/payments', 'Api\v2\CollectionController@getAllPayments');

        });
        Route::resource('collections', 'Api\v2\CollectionController', [
            'only'      =>  [
                'update'
            ]
        ]);

        Route::group(['prefix' => 'customers'], function(){
           
            Route::get('/reservations', 'Api\v2\CustomerController@getAllCustomersWithReservations');
            Route::get('/{customerId}/reservations', 'Api\v2\CustomerController@getAllReservationsWithPayable');
            Route::get('/reservations/void', 'Api\v2\CustomerController@getAllCustomersWithVoidReservations');
            Route::get('/collections', 'Api\v2\CustomerController@getCustomersWithCollections');
            Route::get('/{id}/collections', 'Api\v2\CustomerController@getAllCollections');
            
        });
        
        Route::group(['prefix'  =>  'rooms'], function(){

            Route::get(         '/{id}/blocks',      'Api\v2\RoomController@getBlocks'                          );
            Route::get('/{id}/roomtypes/units', 'Api\v2\RoomController@getRoomTypeWithUnit');

        });
        Route::resource(        'rooms',            'Api\v2\RoomController'                                     );

        Route::group(['prefix'  =>  'roomtypes'], function(){

            Route::get('/unit', 'Api\v2\RoomTypeController@getAllRoomTypeWithUnit');

        });
        Route::resource(        'roomtypes',        'Api\v2\RoomTypeController',    [
            'only'  =>  [
                'index',
                'store'
            ]
        ]);

        Route::group(['prefix' => 'buildings'], function(){

            Route::get(         '/{id}/floors',         'Api\v2\BuildingController@getAllFloors'                   );
            Route::get(         '/{id}/floors/blocks',  'Api\v2\BuildingController@getAllFloorsWithBlocks'         );
            Route::get(         '/{id}/floors/rooms',   'Api\v2\BuildingController@getAllFloorsWithRooms'          );

        });

        Route::resource('buy-units', 'Api\v2\BuyUnitController', [
            'only'  =>  [
                'store'
            ]
        ]);

        Route::group(['prefix' => 'floors'], function(){

            Route::get(         '/{id}/rooms',                      'Api\v2\FloorController@getAllRooms'                        );
            Route::get(         '/{id}/rooms/blocks',               'Api\v2\FloorController@getAllRoomsWithBlocks'              );
            Route::get(         '/{id}/rooms/unit-type',            'Api\v2\FloorController@getAllRoomsWithUnitType'            );
            Route::get(         '/{id}/unit-categories',            'Api\v2\FloorController@getAllUnitCategories'               );
            Route::get('/{floorId}/unit-categories/{unitTypeId}',   'Api\v2\FloorController@getAllUnitCategoriesWithUnitType'   );

        });

        Route::group(['prefix' => 'interests'], function(){

            Route::get( '/normal',                          'Api\v2\InterestController@getAllInterests'                 );
            Route::get( '/at-need',                         'Api\v2\InterestController@getAllAtNeedInterests'           );

        });

        Route::group(['prefix' => 'reservations'], function(){

            Route::get('/{id}/downpayments', 'Api\v2\ReservationController@getAllDownpayments');
            Route::post('/due-date', 'Api\v2\ReservationController@deleteDueDateReservations');

        });
        Route::resource('reservations',                             'Api\v2\ReservationController',
            [
                'only'  =>  [
                    'store',
                    'destroy'
                ]
            ]);

        Route::resource('downpayments', 'Api\v2\DownpaymentController',
            [
                'only'  =>  [
                    'store'
                ]
            ]);

        Route::resource('service-categories', 'Api\v2\ServiceCategoryController', [
            'only'  =>  [
                'store',
                'index'
            ]
        ]);

        Route::group(['prefix'  =>  'services'], function(){

            Route::get('/archive', 'Api\v2\ServiceController@archive');
            Route::post('/{id}/enable', 'Api\v2\ServiceController@enable');

        });
        Route::resource('services', 'Api\v2\ServiceController');

        Route::group(['prefix' => 'units'], function(){

            Route::get('/{id}/info', 'Api\v2\UnitController@getUnitInfo');

        });
        Route::resource('units', 'Api\v2\UnitController', [
            'only'  =>  [
                'show',
                'destroy',
                'update'
            ]
        ]);

        Route::resource('unit-categories', 'Api\v2\UnitCategoryController', [
            'only'  =>  [
                'show',
                'update'
            ]
        ]);

    });

});
