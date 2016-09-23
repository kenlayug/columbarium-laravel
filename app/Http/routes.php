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
Route::group(['prefix' => 'pdf'], function(){
    //Reports PDF
    Route::get('/sales-report', function(){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.sales-report');
        return $pdf->stream('sales-report.pdf');
    });
    Route::get('/unit-purchase-report/{dateFrom}/{dateTo}', 'Api\v3\TransactionUnitController@generatePdf');
    Route::get('/collection-report/{dateFrom}/{dateTo}', 'Api\v2\DownpaymentController@generatePdf');
    Route::get('/manage-unit-report/{dateFrom}/{dateTo}', 'Api\v3\TransactionDeceasedController@generatePdf');
    Route::get('/transfer-ownership-report/{dateFrom}/{dateTo}', 'Api\v3\TransactionDeceasedController@generatePdfTransferOwnershipReport');
    Route::get('/schedule-report', function(){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.schedule-report');
        return $pdf->stream('schedule-report.pdf');
    });
    Route::get('/receivables-report', 'Api\v3\ReceivableController@generatePdf');
    Route::get('/overview-report', function(){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.overview-report');
        return $pdf->stream('overview-report.pdf');
    });

    Route::get('/service-purchase-success', function(){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.service-purchase-success');
        return $pdf->stream('service-purchase-success.pdf');
    });
    Route::get('/manage-schedule-success', function(){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.manage-schedule-success');
        return $pdf->stream('manage-schedule-success.pdf');
    });

    //Success Modals (PDF)

    //Unit Purchases
    Route::get('/unit-purchase-success/{id}', 'Pdf\UnitPurchasePdf@generatePdf');
    //Collections
    Route::get('/collections-success/{id}', 'Pdf\CollectionPdfController@generateCollection');
    Route::get('/downpayments-success/{id}', 'Pdf\CollectionPdfController@generateDownpayment');
    //Manage Unit
    Route::get('/manage-unit-success/{id}', 'Pdf\ManageUnitPdfController@generatePdf');
});


Route::get('/user-seed', 'UserSeed@index');

Route::group(['middleware' => 'login'], function(){

    Route::get('login-page', function(){

        return view('v2.login');

    });

});

// Route::group(['middleware'  =>  'auth'], function(){

    Route::get('discount-maintenance', function(){

        return view('v2.discountMaintenance');

    });

    Route::get('assign-discount-maintenance', function(){

        return view('v2.assignDiscountMaintenance');

    });


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

    Route::get('receivables-report', function(){

        return view('v2.receivablesReport2');

    });

    Route::get('overview-report', function(){

        return view('v2.overviewReport');

    });

    Route::get('receipt-query', function(){

    return view('v2.receiptQuery');

    });

    Route::get('unit-query', function(){

    return view('v2.unitQuery');

    });

    Route::get('discount-query', function(){

    return view('v2.discountQuery');

    });

    Route::get('interest-query', function(){

    return view('v2.interestQuery');

    });

    Route::get('schedule-query', function(){

    return view('v2.scheduleQuery');

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

        return view('v2.unitPurchase2');

    });

    Route::get('manage-unit-transaction', function(){

        return view('v2.manageUnitTransaction3');

    });

    Route::get('service-purchase-transaction', function(){

        return view('v2.servicePurchaseTransaction');

    });

    Route::get('assign-schedule-transaction', function(){

        return view('v2.assignScheduleTransaction');

    });

    Route::get('business-dependency-utility', function(){

        return view('v2.utilities');

    });
    Route::get('unit-servicing-utility', function(){

        return view('v2.unitServicing');

    });
    Route::get('system-dependency-utility', function(){

        return view('v2.systemDependency');

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

// });

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
            Route::post('/deactivate', 'AdditionalController@deactivateAll');
            Route::post('/reactivate', 'AdditionalController@reactivateAll');
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
            Route::get('/archive', 'Api\v2\BlockController@archive');
            Route::post('/{id}/reactivate', 'Api\v2\BlockController@restore');

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
            Route::get('/reports/{dateFrom}/to/{dateTo}', 'Api\v2\DownpaymentController@getTabularReport');
            Route::get('/reports/{dateFilter}/weekly', 'Api\v2\DownpaymentController@getWeeklyStatistics');
            Route::get('/reports/{dateFilter}/monthly', 'Api\v2\DownpaymentController@getMonthlyStatistics');
            Route::get('/reports/{dateFilter}/quarterly', 'Api\v2\DownpaymentController@getQuarterlyStatistics');
            Route::get('/reports/{dateFilter}/yearly', 'Api\v2\DownpaymentController@getYearlyStatistics');

            Route::get('/reports/{dateFilter}/monthly/growth-rate', 'Api\v2\DownpaymentController@getMonthlyGrowthRate');
            Route::get('/reports/{dateFilter}/quarterly/growth-rate', 'Api\v2\DownpaymentController@getQuarterlyGrowthRate');
            Route::get('/reports/{dateFilter}/yearly/growth-rate', 'Api\v2\DownpaymentController@getYearlyGrowthRate');

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
            Route::get('/units', 'Api\v2\CustomerController@getAllCustomersWithUnitTransaction');
            Route::get('{id}/units', 'Api\v2\CustomerController@getCustomerUnits');
            Route::get('/collectibles', 'Api\v2\CustomerController@getCustomerWithCollectibles');
            Route::get('/{id}/collectibles', 'Api\v2\CustomerController@getCustomerCollectibles');
            Route::get('/notifications', 'Api\v2\CustomerController@getCustomersWithSentNotif');
            Route::get('/services', 'Api\v2\CustomerController@getCustomersWithUnscheduledService');

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

        Route::resource('positions', 'Api\v2\PositionController');

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
            Route::get('/archive', 'Api\v2\RoomController@archive');
            Route::post('/{id}/reactivate', 'Api\v2\RoomController@reactivate');

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
            Route::get('/scheduled', 'Api\v2\ServiceCategoryController@getAllScheduleServiceCategory');
            Route::get('/{id}/schedule-logs', 'Api\v2\ServiceCategoryController@getScheduleLog');
            Route::post('/{id}/schedule-logs/{slId}', 'Api\v2\ServiceCategoryController@createNewTimeScheduleLog');
            Route::get('/{id}/schedule-logs/{slId}/{dateSchedule}', 'Api\v2\ServiceCategoryController@getAllTimeScheduleLog');

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

            Route::post('/deactivate', 'Api\v2\ServiceController@deactivateAll');
            Route::post('/reactivate', 'Api\v2\ServiceController@reactivateAll');

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

            Route::group(['prefix' => 'reports'], function(){

                Route::post('/', 'Api\v3\TransactionDeceasedController@getReports');
                Route::get('/{dateFilter}/weekly', 'Api\v3\TransactionDeceasedController@getWeeklyStatistics');
                Route::get('/{dateFilter}/monthly', 'Api\v3\TransactionDeceasedController@getMonthlyStatistics');
                Route::get('/{dateFilter}/quarterly', 'Api\v3\TransactionDeceasedController@getQuarterlyStatistics');
                Route::get('/{dateFilter}/yearly', 'Api\v3\TransactionDeceasedController@getYearlyStatistics');
                Route::get('/{dateFilter}/monthly/growth-rate', 'Api\v3\TransactionDeceasedController@getMonthlyGrowthRate');
                Route::get('/{dateFilter}/quarterly/growth-rate', 'Api\v3\TransactionDeceasedController@getQuarterlyGrowthRate');
                Route::get('/{dateFilter}/yearly/growth-rate', 'Api\v3\TransactionDeceasedController@getYearlyGrowthRate');

            });

        });

        Route::group(['prefix' => 'transfer-ownership/reports'], function(){

            Route::post('/', 'Api\v3\TransactionDeceasedController@getTransferOwnershipReports');
            Route::get('/{dateFilter}/weekly', 'Api\v3\TransactionDeceasedController@getWeeklyStatisticsTransferOwnership');
            Route::get('/{dateFilter}/monthly', 'Api\v3\TransactionDeceasedController@getMonthlyStatisticsTransferOwnership');
            Route::get('/{dateFilter}/quarterly', 'Api\v3\TransactionDeceasedController@getQuarterlyStatisticsTransferOwnership');
            Route::get('/{dateFilter}/yearly', 'Api\v3\TransactionDeceasedController@getYearlyStatisticsTransferOwnership');

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
        Route::resource('units', 'Api\v2\UnitController');

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

        Route::resource('employees', 'Api\v2\UserController');

    });


    Route::group(['prefix' => 'v3'], function(){

        Route::resource('assign-discounts', 'Api\v3\AssignDiscountController');

        Route::group(['prefix' => 'collections'], function(){

            Route::get('/{id}/payments', 'Api\v3\CollectionController@getCollectionPayment');

            Route::group(['prefix' => 'reports'], function(){

                Route::post('/', 'Api\v3\CollectionController@getReports');

            });

        });

        Route::group(['prefix' => 'deceased'], function(){

            Route::get('/units', 'Api\v3\DeceasedController@getAllDeceasedInUnit');

        });

        Route::group(['prefix' => 'discounts'], function(){

            Route::get('/archive', 'Api\v3\DiscountController@archive');
            Route::post('/{id}/reactivate', 'Api\v3\DiscountController@reactivate');

        });
        Route::resource('discounts', 'Api\v3\DiscountController');

        Route::group(['prefix' => 'interests'], function(){

            Route::get('/archive', 'Api\v3\InterestController@archive');
            Route::post('/{id}/reactivate', 'Api\v3\InterestController@reactivate');
            Route::post('/deactivateAll', 'Api\v3\InterestController@deactivateAll');
            Route::post('/reactivateAll', 'Api\v3\InterestController@reactivateAll');

        });
        Route::resource('interests', 'Api\v3\InterestController');

        Route::post('/auth/{email}/{password}', 'Api\v3\LoginController@login');
        Route::get('/auth', 'Api\v3\LoginController@getUserLogin');
        Route::get('/auth/logout', 'Api\v3\LoginController@logout');

        Route::resource('notifications', 'Api\v3\NotificationController');

        Route::group(['prefix'  =>  'schedules'], function(){

            Route::get('/', 'Api\v3\ScheduleController@getScheduleDetailLogsForTheDay');
            Route::post('/{intScheduleDetailId}', 'Api\v3\ScheduleController@processSchedule');
            Route::get('/{intScheduleLogId}/dates/{dateSchedule}', 'Api\v3\ScheduleController@getScheduleForDay');
            Route::put('/{intScheduleDetailId}', 'Api\v3\ScheduleController@reschedule');
            Route::delete('/{intScheduleDetailId}', 'Api\v3\ScheduleController@cancel');
            Route::get('/{dateFilter}', 'Api\v3\ScheduleController@getAllScheduleForDate');

        });

        Route::resource('receipts', 'Api\v3\ReceiptController');

        Route::resource('receivables', 'Api\v3\ReceivableController');

        Route::resource('sms', 'Sample\SmsController');

        Route::group(['prefix' => 'transaction-deceased'], function(){

            Route::post('/add', 'Api\v3\TransactionDeceasedController@add');

        });

        Route::group(['prefix' => 'transaction-purchases'], function(){

            Route::group(['prefix' => 'reports'], function(){
                Route::post('/{id}', 'Api\v3\ServicePurchaseController@getReports');
                Route::get('/{dateNow}/weekly', 'Api\v3\ServicePurchaseController@getWeeklyStatistics');
                Route::get('/{dateNow}/monthly', 'Api\v3\ServicePurchaseController@getMonthlyStatistics');
                Route::get('/{dateNow}/quarterly', 'Api\v3\ServicePurchaseController@getQuarterlyStatistics');
                Route::get('/{dateNow}/yearly', 'Api\v3\ServicePurchaseController@getYearlyStatistics');
            });

        });
        Route::resource('transaction-purchases', 'Api\v3\ServicePurchaseController');

        Route::group(['prefix' => 'transaction-units'], function(){

            Route::group(['prefix' => 'reports'], function(){

                Route::post('/', 'Api\v3\TransactionUnitController@getReports');
                Route::get('/{dateFilter}/weekly', 'Api\v3\TransactionUnitController@getWeeklyReports');
                Route::get('/{dateFilter}/monthly', 'Api\v3\TransactionUnitController@getMonthlyReports');
                Route::get('/{dateFilter}/quarterly', 'Api\v3\TransactionUnitController@getQuarterlyReports');
                Route::get('/{dateFilter}/yearly', 'Api\v3\TransactionUnitController@getYearlyReports');
                Route::get('/{dateFilter}/monthly/growth-rate', 'Api\v3\TransactionUnitController@getMonthlyGrowthRate');
                Route::get('/{dateFilter}/quarterly/growth-rate', 'Api\v3\TransactionUnitController@getQuarterlyGrowthRate');
                Route::get('/{dateFilter}/yearly/growth-rate', 'Api\v3\TransactionUnitController@getYearlyGrowthRate');

            });
            Route::post('/{id}/switch', 'Api\v3\TransactionUnitController@update');

        });
        Route::resource('transaction-units', 'Api\v3\TransactionUnitController');

        Route::group(['prefix' => 'units'], function(){

            Route::get('/status', 'Api\v3\UnitController@getAllUnitStatus');

        });

    });

});
