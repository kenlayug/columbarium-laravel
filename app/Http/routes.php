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
Route::get('sales-report', function(){

    return view('v2.salesReport');

});

Route::get('unit-purchases-report', function(){

    return view('v2.unitPurchasesReport');

});

Route::get('collection-downpayment-report', function(){

    return view('v2.collectionDownpaymentReport');

});

Route::get('manage-unit-report', function(){

    return view('v2.manageUnitReport');

});

Route::get('transfer-ownership-report', function(){

    return view('v2.transferOwnershipReport');

});

Route::get('assign-schedule-report', function(){

    return view('v2.assignScheduleReport');

});


Route::get('interest-query', function(){

return view('v2.interestQuery');

});

Route::get('building-query', function(){

return view('v2.buildingQuery');

});

Route::get('room-query', function(){

return view('v2.roomQuery');

});

Route::get('block-query', function(){

return view('v2.blockQuery');

});

Route::get('unit-price-query', function(){

return view('v2.unitPriceQuery');

});

Route::get('service-query', function(){

return view('v2.serviceQuery');

});

Route::get('package-query', function(){

return view('v2.packageQuery');

});

Route::get('additional-query', function(){

return view('v2.additionalQuery');

});



Route::get('/', function(){

    return view('v2.dashboard');

});

Route::get('queries-page', function(){

    return view('v2.queries');

});

Route::get('reports', function(){

    return view('v2.reports');

});

Route::get('schedule', function(){
    return view('scheduleTransaction');
});

Route::get('unit-purchase-transaction', function(){

    return view('v2.unitPurchase');

});

Route::get('manage-unit-transaction', function(){

    return view('v2.manageUnitTransaction');

});

Route::get('service-purchase-transaction', function(){

    return view('v2.servicePurchaseTransaction');

});

Route::get('assign-schedule-transaction', function(){

    return view('v2.assignScheduleTransaction');

});

Route::get('login', function(){

    return view('v2.login');

});

Route::get('business-dependency-utility', function(){

    return view('v2.utilities');

});
Route::get('unit-servicing-utility', function(){

    return view('v2.unitServicing');

});
Route::get('downpayment-transaction',   'PageController\DownpaymentController@pageUp'       );

Route::get('customer-transaction',      'PageController\CustomerPageController@pageUp'      );
Route::get('collection-downpayment-transaction',    'PageController\CollectionController@pageUp'     );

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
            Route::delete('/{id}', 'PackageController@destroy');
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

        Route::resource('at-needs', 'Api\v2\AtNeedController', [
            'only'  =>  [
                'store'
            ]
        ]);

        Route::group(['prefix'  =>  'blocks'], function(){

            Route::get(         '/{id}/units',      'Api\v2\BlockController@getUnits'                           );
            Route::get('/unitTypes/{unitTypeId}', 'Api\v2\BlockController@getBlocksWithUnitType');

        });
        Route::resource(        'blocks',           'Api\v2\BlockController'                                    );

        Route::group(['prefix' => 'buildings'], function(){

            Route::get(         '/{id}/floors',         'Api\v2\BuildingController@getAllFloors'                   );
            Route::get(         '/{id}/floors/blocks',  'Api\v2\BuildingController@getAllFloorsWithBlocks'         );
            Route::get(         '/{id}/floors/rooms',   'Api\v2\BuildingController@getAllFloorsWithRooms'          );
            Route::post('/activate', 'Api\v2\BuildingController@activateAll');
            Route::post('/deactivate', 'Api\v2\BuildingController@deactivateAll');

        });
        Route::resource('buildings', 'BuildingController');

        Route::resource('business-dependencies', 'Api\v2\BusinessDependencyController', [
            'only'    =>  [
                'index', 'store', 'show'
            ]
        ]);

        Route::resource('buy-units', 'Api\v2\BuyUnitController', [
            'only'  =>  [
                'store'
            ]
        ]);

        Route::group(['prefix' => 'collections'], function(){

            Route::get('/{id}/payments', 'Api\v2\CollectionController@getAllPayments');
            Route::post('/due-dates', 'Api\v2\CollectionController@deleteOverDueCollections');

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
            Route::post('/', 'Api\v2\CustomerController@getCustomer');
            Route::get('/downpayments', 'Api\v2\CustomerController@getCustomersWithDownpayment');
            Route::get('/{id}/downpayments', 'Api\v2\CustomerController@getCustomerDownpayment');
            Route::get('/{id}/deceases', 'Api\v2\CustomerController@getCustomerDeceased');

        });

        Route::resource('deceases', 'Api\v2\DeceasedController');

        Route::group(['prefix' => 'downpayments'], function(){

            Route::post('/due-dates', 'Api\v2\DownpaymentController@deleteDueDateDownpayment');
            Route::post('/warning', 'Api\v2\DownpaymentController@sendWarningDeadlines');
            Route::get('/{id}/payments', 'Api\v2\DownpaymentController@getAllPayments');

        });

        Route::resource('downpayments', 'Api\v2\DownpaymentController',
            [
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
            Route::post( '/activateAll',                     'InterestController@activateAll'           );
            Route::post( '/deactivateAll',                     'InterestController@deactivateAll'           );

        });
        Route::resource('interests', 'InterestController');

        Route::resource('relationships', 'Api\v2\RelationshipController', [
            'only'  =>  [
                'index', 'store'
            ]
        ]);

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

        Route::group(['prefix'  =>  'rooms'], function(){

            Route::get(         '/{id}/blocks',      'Api\v2\RoomController@getBlocks'                          );
            Route::get('/{id}/roomtypes/units', 'Api\v2\RoomController@getRoomTypeWithUnit');

        });
        Route::resource(        'rooms',            'Api\v2\RoomController'                                     );

        Route::group(['prefix'  =>  'roomtypes'], function(){

            Route::get('/units', 'Api\v2\RoomTypeController@getAllRoomTypeWithUnit');
            Route::get('/{id}/storage-types', 'Api\v2\RoomTypeController@getStorageType');
            Route::get('/{id}/storage-types/info', 'Api\v2\RoomTypeController@getStorageTypeWithInfo');

        });
        Route::resource(        'roomtypes',        'Api\v2\RoomTypeController',    [
            'only'  =>  [
                'index',
                'store'
            ]
        ]);

        Route::resource('safe-boxes', 'Api\v2\SafeBoxController');

        Route::group(['prefix'  =>  'service-categories'], function(){

            Route::post('/{id}/time', 'Api\v2\ServiceCategoryController@createNewTime');
            Route::get('/{id}/time/{dateSchedule}', 'Api\v2\ServiceCategoryController@getAllTime');

        });
        Route::resource('service-categories', 'Api\v2\ServiceCategoryController', [
            'only'  =>  [
                'store',
                'index'
            ]
        ]);

        Route::group(['prefix'  =>  'services'], function(){

            Route::get('/archive', 'Api\v2\ServiceController@archive');
            Route::post('/{id}/enable', 'Api\v2\ServiceController@enable');
            Route::get('/{id}/requirements', 'Api\v2\ServiceController@getRequirements');
            Route::get('/units', 'Api\v2\ServiceController@getServicesWithUnitServicing');
            Route::get('/others', 'Api\v2\ServiceController@getServicesWithOthers');

        });
        Route::resource('services', 'Api\v2\ServiceController');

        Route::resource('storage-types', 'Api\v2\StorageTypeController', [
            'only'  =>  [
                'index', 'store'
            ]
        ]);

        Route::group(['prefix'  =>  'transaction-deceased'], function(){

            Route::post('/add', 'Api\v2\TransactionDeceasedController@add');
            Route::post('/transfer', 'Api\v2\TransactionDeceasedController@transfer');
            Route::post('/{intUnitId}/pull', 'Api\v2\TransactionDeceasedController@pull');
            Route::post('/{id}/return', 'Api\v2\TransactionDeceasedController@returnDeceased');

        });

        Route::resource('transaction-deceased', 'Api\v2\TransactionDeceasedController', [
            'only'  =>  [
                'store'
            ]
        ]);

        Route::resource('transaction-purchases', 'Api\v2\TransactionPurchaseController', [
            'only'  =>  [
                'store'
            ]
        ]);

        Route::group(['prefix' => 'units'], function(){

            Route::get('/{id}/info', 'Api\v2\UnitController@getUnitInfo');
            Route::get('/{id}/deceases', 'Api\v2\UnitController@getAllDeceased');
            Route::post('/{intUnitId}/transfer', 'Api\v2\UnitController@transferOwnership');

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
                'index',
                'show',
                'store'
            ]
        ]);

        Route::resource('unit-services', 'Api\v2\UnitServiceController', [
            'only'  =>  [
                'show',
                'store'
            ]
        ]);

        Route::resource('unit-storages', 'Api\v2\UnitTypeStorageController', [
            'only'  =>  [
                'update'
            ]
        ]);

    });


    Route::group(['prefix' => 'v3'], function(){

        Route::group(['prefix' => 'collections'], function(){

            Route::get('/{id}/payments', 'Api\v3\CollectionController@getCollectionPayment');

        });

        Route::resource('sms', 'Sample\SmsController');

        Route::group(['prefix' => 'transaction-deceased'], function(){

            Route::post('/add', 'Api\v3\TransactionDeceasedController@add');

        });

        Route::resource('transaction-purchases', 'Api\v3\ServicePurchaseController');

    });

});
