<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PersonsController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\AliquotValuesController;
use App\Http\Controllers\CondonationsController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\PeriodsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\auth\UserController;

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


    Route::resource('Users', UserController::class);
    
    Route::resource('Persons', PersonsController::class);

    Route::resource('Properties',PropertiesController::class);
    Route::resource('Payments',PaymentsController::class)->only(['index','store']);

    Route::resource('AliquotValues',AliquotValuesController::class);

    Route::resource('Condonations',CondonationsController::class)->only(['index','store']);
    Route::resource('Companies',CompaniesController::class)->only(['index','update','edit','store']);

    Route::resource('Periods',PeriodsController::class)->only(['index','store']);

    Route::get(
        '/Payments/{propertyId}/createCondonation', 
        [PaymentsController::class,'createCondonation']
    )->name('Payments.createCondonation'); 


    Route::post(
        '/Payments/{propertyId}/storeCondonation', 
        [PaymentsController::class,'storeCondonation']
    )->name('Payments.storeCondonation'); 


    Route::get(
        '/AliquotValues/{id}/destroy', 
        [AliquotValuesController::class,'destroy']
    )->name('AliquotValues.destroy'); 

    
    Route::get(
        '/Persons/{id}/destroy', 
        [PersonsController::class,'destroy']
    )->name('Persons.destroy'); 

    Route::get(
        '/Persons/{id}/properties', 
        [PersonsController::class,'properties']
    )->name('Persons.properties'); 

    Route::get(
        '/Persons/{id}/properties', 
        [PersonsController::class,'properties']
    )->name('Persons.properties'); 

    Route::get(
        '/Properties/{id}/create', 
        [PropertiesController::class,'create']
    )->name('Properties.create');

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

    Route::get('/TotalPayments', [ReportsController::class, 'totalPayments']);
    Route::get('/TotalPortfolio', [ReportsController::class, 'totalPorfolioReceivable']);
    

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


    Route::get('/TotalPayments', 
        [ReportsController::class, 'totalPayments']
    )->name('ReportsController.totalPayments');


    Route::get('/TotalPortfolio', 
        [ReportsController::class, 'totalPorfolioReceivable']
    )->name('ReportsController.totalPorfolioReceivable');


    Route::get('/TotalCondonation', 
        [ReportsController::class, 'totalCondonation']
    )->name('ReportsController.totalCondonation');


    Route::get(
        '/PaymentsExcel', 
        [ReportsController::class,'exportPayments']
    )->name('Reports.exportPayments');

    Route::get(
        '/PortofolioExcel', 
        [ReportsController::class,'exportPorfolioReceivable']
    )->name('Reports.exportPorfolioReceivable');

    Route::get(
        '/CondonationExcel', 
        [ReportsController::class,'exportCondonation']
    )->name('Reports.exportCondonation');

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
