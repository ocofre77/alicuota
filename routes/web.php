<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PersonsController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\PaymentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'auth'], function () {

    // Route::get('/Persons', [PersonsController::class, 'index']);
    // Route::post('/Persons', [PersonsController::class, 'store']);
    // Route::get('/Persons/create', [PersonsController::class, 'create']);
    // Route::get('/Persons/{Person}', [PersonsController::class, 'show']);
    // Route::put('/Persons/{Person}', [PersonsController::class, 'update']);
    // Route::delete('/Persons/{Person}', [PersonsController::class, 'destroy']);
    // Route::get('/Persons/{Person}/edit', [PersonsController::class, 'edit']);
    // Route::get('/Persons/{Person}/destroy', [PersonsController::class, 'destroy']);


    Route::resource('Persons', PersonsController::class);
    Route::resource('Properties',PropertiesController::class);
    Route::resource('Payments',PaymentsController::class)->only(['index','store']);

    // Route::resource('AliquotValues',AliquotValuesController::class);

    // Route::resource('Condonations',CondonationsController::class)->only(['index','store']);
    // Route::resource('Companies',CompaniesController::class)->only(['index','update','edit','store']);

    // Route::resource('Periods',PeriodsController::class)->only(['index','store']);

    // Route::get('/Payments/{propertyId}/createCondonation', [
    //                 'uses' => 'PaymentsController@createCondonation',
    //                 'as' => 'Payments.createCondonation'
    //         ]
    // );
    // Route::post('/Payments/{propertyId}/storeCondonation', [
    //                 'uses' => 'PaymentsController@storeCondonation',
    //                 'as' => 'Payments.storeCondonation'
    //         ]
    // );

    // Route::get('/AliquotValues/{id}/destroy', [
  	// 				'uses' => 'AliquotValuesController@destroy',
  	// 				'as' => 'AliquotValues.destroy'
  	// 		]
  	// );

	// Route::get('/Persons/{id}/destroy', [
	// 				'uses' => 'PersonsController@destroy',
	// 				'as' => 'Persons.destroy'
	// 		]
	// );
    // Route::get('/Persons/{id}/properties', [
	// 				'uses' => 'PersonsController@properties',
	// 				'as' => 'Persons.properties'		]
	// );

    Route::get('/Properties/{id}/create', [
                    'uses' => 'PropertiesController@create',
                    'as' => 'Properties.create'
            ]
    );
    // Route::get('Properties/{Property}/{Person}/edit',[
    //     'uses' => 'PropertiesController@edit',
    //     'as' => 'Properties.edit'
    // ]
    // );
    // Route::get('/Properties/{id}/destroy', [
	// 				'uses' => 'PropertiesController@destroy',
	// 				'as' => 'Properties.destroy'
	// 		]
	// );

    // Route::get('/Persons/{id}/destroy', [
	// 				'uses' => 'PersonsController@destroy',
	// 				'as' => 'Persons.destroy'
	// 		]
	// );

    // Route::get('/TotalPayments', [
	// 				'uses' => 'ReportsController@totalPayments',
	// 				'as' => 'ReportsController.totalPayments'
	// 		]
	// );

    // Route::get('/TotalPortfolio', [
	// 				'uses' => 'ReportsController@totalPorfolioReceivable',
	// 				'as' => 'ReportsController.totalPorfolioReceivable'
	// 		]
	// );
    // Route::get('/TotalCondonation', [
    //     'uses' => 'ReportsController@totalCondonation',
    //     'as' => 'ReportsController.totalCondonation'
    // ]
    // );


    // Route::get('/PaymentsExcel',[
    //     'uses'=> 'ReportsController@exportPayments',
    //     'as' => 'Reports.exportPayments'
    // ]);

    // Route::get('/PortofolioExcel',[
    //     'uses'=> 'ReportsController@exportPorfolioReceivable',
    //     'as' => 'Reports.exportPorfolioReceivable'
    // ]);

    // Route::get('/CondonationExcel',[
    //     'uses'=> 'ReportsController@exportCondonation',
    //     'as' => 'Reports.exportCondonation'
    // ]);



    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
