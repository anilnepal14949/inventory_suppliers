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


use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'],function(){
	get('/', ['as'=>'home','uses'=>'Dashboard\DashboardController@index']);
	get('/getStockTable',['as'=>'getStockTable','uses'=>'HomeController@getStockTable']);
	get('/backup', ['as'=>'backup', 'uses'=>'HomeController@backup']);
});

Route::group(['prefix'=>'dashboard'],function(){
	get('/',['as'=>'dashboard','uses'=>'Dashboard\DashboardController@index']);
});

Route::group(['prefix'=>'company'],function(){
    /*oompany information first page*/
    get('/', ['as'=>'company','uses'=>'Company\CompanyController@index']);
	
	/*oompany information*/
    resource('add-company','Company\CompanyController',
        ['names'=>[
            'index'=>'add.company.index'
        ]]);
});

Route::group(['prefix'=>'customer'],function(){
    /*customer information first page*/
    get('/', ['as'=>'customer','uses'=>'Customer\CustomerController@index']);
	
	/*customer information*/
    resource('add-customer','Customer\CustomerController',
        ['names'=>[
            'index'=>'add.customer.index'
        ]]);
});


Route::group(['prefix'=>'particular'],function(){
    /*particular information first page*/
    get('/', ['as'=>'particular','uses'=>'Particular\ParticularController@index']);
	
	/*particular information*/
    resource('add-particular','Particular\ParticularController',
        ['names'=>[
            'index'=>'add.particular.index'
        ]]);
});

Route::group(['prefix'=>'purchase'],function(){
    /*purchase information first page*/
    get('/', ['as'=>'purchase','uses'=>'Purchase\PurchaseController@index']);
	
	/*purchase information*/
    resource('add-purchase','Purchase\PurchaseController',
        ['names'=>[
            'index'=>'add.purchase.index'
        ]]);
});

Route::group(['prefix'=>'sales'],function(){
    /*sales information first page*/
    get('/', ['as'=>'sales','uses'=>'Sales\SalesController@index']);
	
	/*purchase information*/
    resource('add-sales','Sales\SalesController',
        ['names'=>[
            'index'=>'add.sales.index'
        ]]);
});

Route::group(['prefix'=>'stock'],function(){
    /*stock information first page*/
    get('/', ['as'=>'stock','uses'=>'Stock\StockController@index']);
	
});

Route::group(['prefix'=>'ledger'],function(){
    /*ledger information first page*/
    get('/', ['as'=>'ledger','uses'=>'Ledger\LedgerController@index']);
	
	post('/generate', ['as'=>'generate','uses'=>'Ledger\LedgerController@generate']);
	
	post('/changeInitialBal', ['as'=>'changeInitialBal','uses'=>'Ledger\LedgerController@changeInitialBal']);
});


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
